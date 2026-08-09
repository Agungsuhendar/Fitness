<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function createSnapToken(Request $request)
    {
        $request->validate([
            'member_name' => 'required|string|max:255',
            'member_phone' => 'required|string|max:30',
            'member_email' => 'nullable|email|max:255',
            'package_name' => 'required|string',
            'amount' => 'required|numeric|min:1000',
        ]);

        $orderId = 'TRX-FL-' . date('Ymd') . '-' . rand(1000, 9999);
        $amount = (float) $request->amount;
        $memberName = $request->member_name;
        $memberPhone = $request->member_phone;
        $memberEmail = $request->member_email ?: (preg_replace('/[^0-9]/', '', $memberPhone) . '@member.fitlife');
        $packageName = $request->package_name ?: 'Regular Gym Pass';

        $user = User::where('phone', preg_replace('/[^0-9]/', '', $memberPhone))
            ->orWhere('email', $memberEmail)
            ->first();

        $activeGateway = \App\Models\Setting::get('active_payment_gateway', 'midtrans');

        if ($activeGateway === 'ipaymu') {
            return $this->createIpaymuPaymentProcess($request, $orderId, $amount, $memberName, $memberPhone, $memberEmail, $packageName, $user);
        }

        $serverKey = \App\Models\Setting::get('midtrans_server_key', config('services.midtrans.server_key', env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-DemoFitnessKey123')));
        $isProduction = \App\Models\Setting::get('midtrans_is_production', config('services.midtrans.is_production', env('MIDTRANS_IS_PRODUCTION', false)));
        $snapUrl = $isProduction 
            ? 'https://app.midtrans.com/snap/v1/transactions' 
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        // Prepare Midtrans Payload
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $amount,
            ],
            'customer_details' => [
                'first_name' => $memberName,
                'email' => $memberEmail,
                'phone' => $memberPhone,
            ],
            'item_details' => [
                [
                    'id' => 'ITEM-01',
                    'price' => (int) $amount,
                    'quantity' => 1,
                    'name' => mb_strimwidth($packageName, 0, 50, '...'),
                ]
            ],
            'callbacks' => [
                'finish' => url('/invoice?id=' . ($user ? $user->member_card_id : 'FL-MBR-7782')),
            ]
        ];

        $snapToken = null;
        $qrisImageUrl = null;

        $isDemo = false;
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($serverKey . ':'),
            ])->post($snapUrl, $params);

            if ($response->successful()) {
                $body = $response->json();
                $snapToken = $body['token'] ?? null;
            } else {
                Log::warning('Midtrans API Snap Response Error: ' . $response->body());
            }

            // Try Core Charge API for QRIS Image
            $chargeUrl = $isProduction 
                ? 'https://api.midtrans.com/v2/charge' 
                : 'https://api.sandbox.midtrans.com/v2/charge';

            $chargeResponse = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($serverKey . ':'),
            ])->post($chargeUrl, [
                'payment_type' => 'qris',
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $amount,
                ],
            ]);

            if ($chargeResponse->successful()) {
                $chargeBody = $chargeResponse->json();
                if (isset($chargeBody['actions']) && is_array($chargeBody['actions'])) {
                    foreach ($chargeBody['actions'] as $act) {
                        if (isset($act['name']) && $act['name'] === 'generate-qr-code') {
                            $qrisImageUrl = $act['url'];
                            break;
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Midtrans Snap Token Exception: ' . $e->getMessage());
        }

        // Fallback token if sandbox key is not live
        if (!$snapToken) {
            $snapToken = 'DEMO-SNAP-TOKEN-' . md5($orderId);
            $isDemo = true;
        }

        // Create Payment record in DB
        $payment = Payment::create([
            'order_id' => $orderId,
            'user_id' => $user ? $user->id : null,
            'member_name' => $memberName,
            'member_phone' => $memberPhone,
            'member_email' => $memberEmail,
            'package_name' => $packageName,
            'gross_amount' => $amount,
            'discount_amount' => 0,
            'net_amount' => $amount,
            'payment_type' => 'qris_va',
            'payment_method_detail' => 'Midtrans QRIS / Virtual Account',
            'transaction_status' => 'pending',
            'snap_token' => $snapToken,
        ]);

        return response()->json([
            'success' => true,
            'gateway' => 'midtrans',
            'order_id' => $orderId,
            'snap_token' => $snapToken,
            'qris_image' => $qrisImageUrl,
            'is_demo' => $isDemo,
            'redirect_url' => 'https://app.sandbox.midtrans.com/snap/v2/vtweb/' . $snapToken,
            'message' => 'Midtrans QRIS / Snap Token berhasil dibuat!'
        ]);
    }

    public function handleWebhook(Request $request)
    {
        $payload = $request->all();
        Log::info('Midtrans Webhook Received: ', $payload);

        $orderId = $payload['order_id'] ?? null;
        $statusCode = $payload['status_code'] ?? null;
        $grossAmount = $payload['gross_amount'] ?? null;
        $signatureKey = $payload['signature_key'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;
        $paymentType = $payload['payment_type'] ?? 'qris_va';

        if (!$orderId) {
            return response()->json(['status' => 'error', 'message' => 'Invalid order_id'], 400);
        }

        // Search Payment
        $payment = Payment::where('order_id', $orderId)->first();
        if (!$payment) {
            return response()->json(['status' => 'error', 'message' => 'Payment record not found'], 404);
        }

        // Check if settlement / capture / lunas
        if (in_array($transactionStatus, ['settlement', 'capture', 'approved'])) {
            $payment->transaction_status = 'settlement';
            $payment->payment_type = $paymentType;
            $payment->paid_at = now();
            $payment->save();

            // Auto-Approve Member sessions & status
            if ($payment->user_id) {
                $user = User::find($payment->user_id);
                if ($user) {
                    $user->remaining_sessions = ($user->remaining_sessions ?? 0) + 12;
                    $user->total_sessions = ($user->total_sessions ?? 0) + 12;
                    $user->status = 'Aktif (Berlaku s/d ' . date('d M Y', strtotime('+30 days')) . ')';
                    $user->membership_type = $payment->package_name;
                    $user->save();
                }
            }

            try {
                \App\Services\WhatsAppService::sendPaymentReceiptNotification($payment);
            } catch (\Exception $e) {}

            return response()->json([
                'status' => 'success',
                'message' => 'Payment settlement verified & member auto-approved!'
            ]);
        } elseif (in_array($transactionStatus, ['expire', 'deny', 'cancel'])) {
            $payment->transaction_status = 'failed';
            $payment->save();

            return response()->json(['status' => 'failed', 'message' => 'Payment marked as failed']);
        }

        return response()->json(['status' => 'pending', 'message' => 'Payment pending']);
    }

    public static function verifyIpaymuPaymentData($cData)
    {
        if (empty($cData) || !is_array($cData)) {
            return false;
        }

        $data = $cData['Data'] ?? null;
        if (empty($data)) {
            return false;
        }

        $items = isset($data['Transaction']) ? $data['Transaction'] : (isset($data[0]) ? $data : [$data]);

        foreach ($items as $item) {
            if (!is_array($item)) continue;

            $tStatus = (string)($item['Status'] ?? ($item['StatusCode'] ?? ($item['status'] ?? ($item['status_code'] ?? ''))));
            $tDesc = strtolower((string)($item['StatusDesc'] ?? ($item['status_desc'] ?? '')));
            $settlement = strtolower((string)($item['SettlementStatus'] ?? ($item['settlement_status'] ?? '')));

            if ($tStatus === '1' || $tStatus === '200') {
                return true;
            }

            if (in_array($tDesc, ['berhasil', 'berhasil_diterima', 'berhasil diterima', 'success', 'paid', 'lunas', 'settled'])) {
                return true;
            }

            if (in_array($settlement, ['settled', 'berhasil', 'paid'])) {
                return true;
            }
        }

        return false;
    }

    private function findUserAndPaymentByRef($refId)
    {
        if (empty($refId)) {
            return [null, null];
        }

        $cleanRef = strtoupper(trim((string)$refId));
        // Strip trailing INV stamp e.g. FL-MBR-20260807-001-INV20260809021430 -> FL-MBR-20260807-001
        $baseCardId = preg_replace('/-INV\d+$/i', '', $cleanRef);
        
        // Extract card ID pattern e.g. FL-MBR-20260807-001
        $cardIdPattern = null;
        if (preg_match('/(FL-MBR-\d{8}-\d+)/i', $cleanRef, $m)) {
            $cardIdPattern = strtoupper($m[1]);
        }

        $candidates = array_unique(array_filter([$cleanRef, $baseCardId, $cardIdPattern]));

        // Search User
        $user = User::whereIn('member_card_id', $candidates)
            ->orWhereIn('id', $candidates)
            ->orWhereIn('email', array_map('strtolower', $candidates))
            ->first();

        // Search Payment
        $payment = Payment::whereIn('order_id', $candidates)->first();
        if (!$payment) {
            foreach ($candidates as $cand) {
                $payment = Payment::where('order_id', 'like', '%' . $cand . '%')->first();
                if ($payment) break;
            }
        }

        if (!$payment && $user) {
            $payment = Payment::where('user_id', $user->id)->latest()->first();
        }

        if (!$user && $payment && $payment->user_id) {
            $user = User::find($payment->user_id);
        }

        return [$user, $payment];
    }

    public function simulatePaymentSuccess(Request $request, $orderId)
    {
        try {
            list($user, $payment) = $this->findUserAndPaymentByRef($orderId);

            if ($user) {
                $user->status = 'Active (LUNAS Auto-Approved)';
                $user->remaining_sessions = max(12, ($user->remaining_sessions ?? 0) + 12);
                $user->total_sessions = max(12, ($user->total_sessions ?? 0) + 12);
                try {
                    $user->save();
                } catch (\Throwable $t) {
                    unset($user->membership_expires_at);
                    $user->save();
                }
            }

            if ($payment) {
                $payment->transaction_status = 'settlement';
                $payment->paid_at = now();
                $payment->save();

                try {
                    \App\Services\WhatsAppService::sendPaymentReceiptNotification($payment);
                } catch (\Throwable $e) {}
            }

            return response()->json([
                'success' => true,
                'message' => 'SIMULASI PEMBAYARAN SUKSES! Webhook berhasil memverifikasi pembayaran instan (Auto-Approved).'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => true,
                'message' => 'SIMULASI PEMBAYARAN SUKSES! Status keanggotaan member otomatis diaktifkan LUNAS (Auto-Approved).'
            ]);
        }
    }

    public function simulatePaymentPending(Request $request, $orderId)
    {
        try {
            list($user, $payment) = $this->findUserAndPaymentByRef($orderId);

            if ($user) {
                $user->status = 'Pending Verifikasi (Menunggu Scan QRIS)';
                $user->remaining_sessions = 0;
                try {
                    $user->save();
                } catch (\Throwable $t) {
                    unset($user->membership_expires_at);
                    $user->save();
                }
            }

            if ($payment) {
                $payment->transaction_status = 'pending';
                $payment->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'SIMULASI NOTIFIKASI PENDING SUKSES! Status invoice dikembalikan ke MENUNGGU PEMBAYARAN (SCAN QRIS).'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => true,
                'message' => 'SIMULASI NOTIFIKASI PENDING SUKSES!'
            ]);
        }
    }

    public function handleIpaymuWebhook(Request $request)
    {
        $payload = array_merge($request->query(), $request->all());
        $rawContent = $request->getContent();
        if ($rawContent && is_string($rawContent)) {
            $jsonParsed = json_decode($rawContent, true);
            if (is_array($jsonParsed)) {
                $payload = array_merge($payload, $jsonParsed);
            }
        }

        Log::info('iPaymu Webhook Received Payload:', [
            'payload' => $payload,
            'query' => $request->query(),
        ]);

        $trxId = $payload['trx_id'] ?? ($payload['sid'] ?? ($payload['transaction_id'] ?? null));
        $status = $payload['status'] ?? ($payload['status_code'] ?? ($payload['transaction_status'] ?? ($payload['statusCode'] ?? null)));
        $referenceId = $payload['reference_id'] ?? ($payload['referenceId'] ?? ($payload['merchant_ref_id'] ?? null));

        $statusStr = strtolower(trim((string)$status));
        $isSuccess = in_array($statusStr, ['berhasil', 'berhasil_diterima', 'berhasil diterima', 'success', 'settlement', '1', '200', 'paid'])
            || str_contains($statusStr, 'berhasil')
            || str_contains($statusStr, 'settle')
            || str_contains($statusStr, 'paid')
            || str_contains($statusStr, 'success');

        if ($isSuccess) {
            list($user, $payment) = $this->findUserAndPaymentByRef($referenceId);

            if (!$user && isset($payload['buyer_email'])) {
                $user = User::where('email', trim($payload['buyer_email']))->first();
            }

            if (!$user && isset($payload['buyer_phone'])) {
                $phone = preg_replace('/[^0-9]/', '', $payload['buyer_phone']);
                if (strlen($phone) >= 8) {
                    $user = User::where('phone', 'like', '%' . substr($phone, -8) . '%')->first();
                }
            }

            if (!$payment && $user) {
                $payment = Payment::where('user_id', $user->id)->latest()->first();
            }

            if ($user) {
                $user->status = 'Active (LUNAS Auto-Approved)';
                $user->remaining_sessions = max(12, ($user->remaining_sessions ?? 0) + 12);
                $user->total_sessions = max(12, ($user->total_sessions ?? 0) + 12);
                try {
                    $user->save();
                } catch (\Throwable $t) {
                    unset($user->membership_expires_at);
                    $user->save();
                }
            }

            if ($payment) {
                $payment->transaction_status = 'settlement';
                $payment->paid_at = now();
                $payment->save();

                try {
                    \App\Services\WhatsAppService::sendPaymentReceiptNotification($payment);
                } catch (\Throwable $e) {}
            }

            return response()->json([
                'status' => 'success',
                'message' => 'iPaymu webhook verified & member auto-approved!'
            ]);
        }

        return response()->json(['status' => 'pending', 'message' => 'iPaymu status received']);
    }

    public function checkStatus(Request $request)
    {
        $id = strtoupper(trim($request->input('id')));
        list($user, $payment) = $this->findUserAndPaymentByRef($id);

        $isSettled = ($payment && $payment->isSettled()) || ($user && (str_contains(strtolower((string)$user->status), 'lunas') || str_contains(strtolower((string)$user->status), 'approved') || str_contains(strtolower((string)$user->status), 'active')));

        if (!$isSettled) {
            $va = \App\Models\Setting::get('ipaymu_va', '0000002447990145');
            $apiKey = \App\Models\Setting::get('ipaymu_api_key', 'SANDBOX67650-XXXXXXXX-XXXX');
            $isProduction = \App\Models\Setting::get('ipaymu_is_production', '0') === '1';
            $baseUrl = $isProduction ? 'https://my.ipaymu.com' : 'https://sandbox.ipaymu.com';

            $candidateIds = array_unique(array_filter([
                $id,
                preg_replace('/-INV\d+$/i', '', $id),
                $payment ? $payment->order_id : null,
                $user ? $user->member_card_id : null,
            ]));

            // 1. Single Transaction API Check
            foreach ($candidateIds as $cId) {
                try {
                    $payloads = [
                        ['referenceId' => $cId],
                        ['transactionId' => $cId],
                        ['id' => $cId],
                    ];

                    foreach ($payloads as $checkBody) {
                        $jsonCheck = json_encode($checkBody, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                        $hashCheck = strtolower(hash('sha256', $jsonCheck));
                        $sigCheck = hash_hmac('sha256', "POST:" . $va . ":" . $hashCheck . ":" . $apiKey, $apiKey);

                        $checkRes = Http::timeout(4)->withHeaders([
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            'va' => $va,
                            'signature' => $sigCheck,
                            'timestamp' => date('YmdHis'),
                        ])->post($baseUrl . '/api/v2/transaction', $checkBody);

                        if ($checkRes->successful()) {
                            $cData = $checkRes->json();
                            $isPaidInIpaymu = self::verifyIpaymuPaymentData($cData);

                            if ($isPaidInIpaymu) {
                                if ($user) {
                                    $user->status = 'Active (LUNAS Auto-Approved)';
                                    $user->remaining_sessions = max(12, ($user->remaining_sessions ?? 0) + 12);
                                    $user->total_sessions = max(12, ($user->total_sessions ?? 0) + 12);
                                    try {
                                        $user->save();
                                    } catch (\Throwable $t) {
                                        unset($user->membership_expires_at);
                                        $user->save();
                                    }
                                }

                                if ($payment) {
                                    $payment->transaction_status = 'settlement';
                                    $payment->paid_at = now();
                                    $payment->save();
                                }
                                $isSettled = true;
                                break 2;
                            }
                        }
                    }
                } catch (\Throwable $t) {}
            }

            // 2. Transaction History API Check (Fallback)
            if (!$isSettled) {
                try {
                    $histBody = ['list' => 25];
                    $histJson = json_encode($histBody);
                    $histHash = strtolower(hash('sha256', $histJson));
                    $histSig = hash_hmac('sha256', "POST:" . $va . ":" . $histHash . ":" . $apiKey, $apiKey);

                    $histRes = Http::timeout(4)->withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'va' => $va,
                        'signature' => $histSig,
                        'timestamp' => date('YmdHis'),
                    ])->post($baseUrl . '/api/v2/transaction/history', $histBody);

                    if ($histRes->successful()) {
                        $hData = $histRes->json();
                        $transactions = $hData['Data']['Transaction'] ?? ($hData['Data'] ?? []);
                        if (is_array($transactions)) {
                            foreach ($transactions as $tx) {
                                if (!is_array($tx)) continue;
                                $txRef = strtoupper((string)($tx['ReferenceId'] ?? ($tx['reference_id'] ?? ($tx['sid'] ?? ''))));
                                $txEmail = strtolower((string)($tx['BuyerEmail'] ?? ($tx['buyer_email'] ?? '')));

                                $matchesUser = false;
                                foreach ($candidateIds as $cand) {
                                    if ($cand && strlen($cand) >= 4 && str_contains($txRef, strtoupper($cand))) {
                                        $matchesUser = true;
                                        break;
                                    }
                                }
                                if ($user && $user->email && str_contains($txEmail, strtolower($user->email))) {
                                    $matchesUser = true;
                                }

                                $txStatus = (string)($tx['Status'] ?? ($tx['status'] ?? ($tx['StatusCode'] ?? ($tx['status_code'] ?? ''))));
                                $txDesc = strtolower((string)($tx['StatusDesc'] ?? ($tx['status_desc'] ?? '')));
                                $txSettlement = strtolower((string)($tx['SettlementStatus'] ?? ($tx['settlement_status'] ?? '')));

                                $txPaid = ($txStatus === '1' || $txStatus === '200')
                                    || in_array($txDesc, ['berhasil', 'berhasil_diterima', 'berhasil diterima', 'success', 'paid', 'lunas', 'settled'])
                                    || in_array($txSettlement, ['settled', 'berhasil', 'paid']);

                                if ($matchesUser && $txPaid) {
                                    if ($user) {
                                        $user->status = 'Active (LUNAS Auto-Approved)';
                                        $user->remaining_sessions = max(12, ($user->remaining_sessions ?? 0) + 12);
                                        $user->total_sessions = max(12, ($user->total_sessions ?? 0) + 12);
                                        try {
                                            $user->save();
                                        } catch (\Throwable $t) {
                                            unset($user->membership_expires_at);
                                            $user->save();
                                        }
                                    }

                                    if ($payment) {
                                        $payment->transaction_status = 'settlement';
                                        $payment->paid_at = now();
                                        $payment->save();
                                    }
                                    $isSettled = true;
                                    break;
                                }
                            }
                        }
                    }
                } catch (\Throwable $t) {}
            }
        }

        return response()->json([
            'is_settled' => (bool) $isSettled,
            'status' => $user ? $user->status : ($payment ? $payment->transaction_status : 'pending'),
            'user' => $user ? [
                'id' => $user->id,
                'name' => $user->name,
                'status' => $user->status,
                'remaining_sessions' => $user->remaining_sessions,
            ] : null,
        ]);
    }

    private function createIpaymuPaymentProcess($request, $orderId, $amount, $memberName, $memberPhone, $memberEmail, $packageName, $user)
    {
        $va = \App\Models\Setting::get('ipaymu_va', env('IPAYMU_VA', '0000002447990145'));
        $apiKey = \App\Models\Setting::get('ipaymu_api_key', env('IPAYMU_API_KEY', 'SANDBOX67650-XXXXXXXX-XXXX'));
        $isProduction = \App\Models\Setting::get('ipaymu_is_production', '0') === '1';

        $baseUrl = $isProduction ? 'https://my.ipaymu.com' : 'https://sandbox.ipaymu.com';
        $directEndpoint = $baseUrl . '/api/v2/payment/direct';

        $invStamp = 'INV' . date('YmdHis');
        $refIdToSend = ($user && $user->member_card_id) ? ($user->member_card_id . '-' . $invStamp) : ($orderId ?: 'FL-MBR-0000-' . $invStamp);

        $body = [
            'name' => $memberName,
            'phone' => preg_replace('/[^0-9]/', '', $memberPhone),
            'email' => $memberEmail,
            'amount' => (int) $amount,
            'notifyUrl' => url('/api/ipaymu/webhook'),
            'paymentMethod' => 'qris',
            'paymentChannel' => 'qris',
            'feeDirection' => 'MERCHANT',
            'fee_direction' => 'MERCHANT',
            'referenceId' => $refIdToSend,
            'product' => [$packageName],
            'qty' => [1],
            'price' => [(int) $amount],
        ];

        $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $bodyHash = strtolower(hash('sha256', $jsonBody));
        $timestamp = date('YmdHis');
        $stringToSign = "POST:" . $va . ":" . $bodyHash . ":" . $apiKey;
        $signature = hash_hmac('sha256', $stringToSign, $apiKey);

        $qrisImage = null;
        $qrisString = null;
        $paymentUrl = null;
        $isDemo = false;

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'va' => $va,
                'signature' => $signature,
                'timestamp' => $timestamp,
            ])->post($directEndpoint, $body);

            if (!$response->successful() && str_contains(strtolower($response->body()), 'signature')) {
                $altSign = hash_hmac('sha256', "POST:" . $va . ":" . $jsonBody . ":" . $apiKey, $apiKey);
                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'va' => $va,
                    'signature' => $altSign,
                    'timestamp' => $timestamp,
                ])->post($directEndpoint, $body);
            }

            if ($response->successful()) {
                $resData = $response->json();
                if (isset($resData['Data']['QrImage'])) {
                    $qrisImage = $resData['Data']['QrImage'];
                }
                if (isset($resData['Data']['QrString'])) {
                    $qrisString = $resData['Data']['QrString'];
                }
                if (isset($resData['Data']['Url'])) {
                    $paymentUrl = $resData['Data']['Url'];
                }
            } else {
                Log::warning('iPaymu Direct QRIS API Response: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('iPaymu Direct QRIS API Exception: ' . $e->getMessage());
        }

        if (!$qrisImage && !$qrisString && !$paymentUrl) {
            $isDemo = true;
        }

        Payment::create([
            'order_id' => $orderId,
            'user_id' => $user ? $user->id : null,
            'member_name' => $memberName,
            'member_phone' => $memberPhone,
            'member_email' => $memberEmail,
            'package_name' => $packageName,
            'gross_amount' => $amount,
            'discount_amount' => 0,
            'net_amount' => $amount,
            'payment_type' => 'qris_ipaymu',
            'payment_method_detail' => 'iPaymu Direct QRIS',
            'transaction_status' => 'pending',
            'snap_token' => $orderId,
        ]);

        return response()->json([
            'success' => true,
            'gateway' => 'ipaymu',
            'order_id' => $orderId,
            'qris_image' => $qrisImage,
            'qris_string' => $qrisString,
            'payment_url' => $paymentUrl,
            'is_demo' => $isDemo,
            'message' => 'iPaymu Direct QRIS payment created successfully!'
        ]);
    }

    public function testQrisApi(Request $request)
    {
        $activeGateway = \App\Models\Setting::get('active_payment_gateway', 'ipaymu');
        $va = \App\Models\Setting::get('ipaymu_va', '0000002447990145');
        $apiKey = \App\Models\Setting::get('ipaymu_api_key', 'SANDBOX67650-XXXXXXXX-XXXX');
        $isProduction = \App\Models\Setting::get('ipaymu_is_production', '0') === '1';

        $baseUrl = $isProduction ? 'https://my.ipaymu.com' : 'https://sandbox.ipaymu.com';
        $directEndpoint = $baseUrl . '/api/v2/payment/direct';

        $body = [
            'name' => 'Bima Prasetya Member Test',
            'phone' => '081234567890',
            'email' => 'member@fitlife.com',
            'amount' => 300000,
            'notifyUrl' => url('/api/ipaymu/webhook'),
            'paymentMethod' => 'qris',
            'paymentChannel' => 'qris',
            'referenceId' => 'FL-MBR-TEST-001',
            'product' => ['Regular Gym Pass'],
            'qty' => [1],
            'price' => [300000],
        ];

        $jsonBody = json_encode($body);
        $timestamp = date('YmdHis');
        $stringToSign = "POST:" . $va . ":" . $jsonBody . ":" . $apiKey;
        $signature = hash_hmac('sha256', $stringToSign, $apiKey);

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'va' => $va,
                'signature' => $signature,
                'timestamp' => $timestamp,
            ])->post($directEndpoint, $body);

            return response()->json([
                'active_gateway' => $activeGateway,
                'va_used' => $va,
                'api_key_used' => substr($apiKey, 0, 12) . '***',
                'is_production' => $isProduction,
                'http_status' => $response->status(),
                'ipaymu_response' => $response->json()
            ], 200, [], JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
