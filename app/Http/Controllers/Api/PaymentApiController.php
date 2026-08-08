<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentApiController extends Controller
{
    /**
     * Checkout payment and generate Midtrans Snap Token
     * POST /api/v1/payments/checkout
     */
    public function checkout(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'package_name' => 'required|string',
            'amount' => 'required|numeric|min:1000',
            'payment_method' => 'nullable|string',
            'member_name' => 'nullable|string',
            'member_phone' => 'nullable|string',
            'member_email' => 'nullable|email',
        ]);

        $orderId = 'TRX-FL-' . date('Ymd') . '-' . rand(1000, 9999);
        $amount = (float) $validated['amount'];
        $packageName = $validated['package_name'];
        $paymentMethod = $validated['payment_method'] ?? 'QRIS';

        $memberName = $user ? $user->name : ($validated['member_name'] ?? 'Budi Pratama Member');
        $memberPhone = $user ? ($user->phone ?? '0812-3456-7890') : ($validated['member_phone'] ?? '0812-3456-7890');
        $memberEmail = $user ? $user->email : ($validated['member_email'] ?? 'member@fitlife.id');

        $serverKey = Setting::get('midtrans_server_key', config('services.midtrans.server_key', env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-DemoFitnessKey123')));
        $isProduction = Setting::get('midtrans_is_production', config('services.midtrans.is_production', env('MIDTRANS_IS_PRODUCTION', false)));
        $snapUrl = $isProduction 
            ? 'https://app.midtrans.com/snap/v1/transactions' 
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

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
        ];

        $snapToken = null;

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($serverKey . ':'),
            ])->post($snapUrl, $params);

            if ($response->successful()) {
                $body = $response->json();
                $snapToken = $body['token'] ?? null;
            }
        } catch (\Exception $e) {
            Log::error('Mobile API Midtrans Snap Exception: ' . $e->getMessage());
        }

        if (!$snapToken) {
            $snapToken = 'SNAP-FL-' . md5($orderId);
        }

        $payment = Payment::create([
            'order_id' => $orderId,
            'user_id' => $user ? $user->id : 1,
            'member_name' => $memberName,
            'member_phone' => $memberPhone,
            'member_email' => $memberEmail,
            'package_name' => $packageName,
            'gross_amount' => $amount,
            'discount_amount' => 50000,
            'net_amount' => $amount,
            'payment_type' => strtolower($paymentMethod),
            'payment_method_detail' => 'Midtrans ' . $paymentMethod,
            'transaction_status' => 'pending',
            'snap_token' => $snapToken,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Checkout pembayaran berhasil dikonfirmasi!',
            'data' => [
                'order_id' => $orderId,
                'package_name' => $packageName,
                'amount' => $amount,
                'payment_method' => $paymentMethod,
                'snap_token' => $snapToken,
                'redirect_url' => 'https://app.sandbox.midtrans.com/snap/v2/vtweb/' . $snapToken,
                'transaction_status' => 'pending',
                'payment' => $payment,
            ]
        ], 201);
    }

    /**
     * Instant payment simulation (QRIS / VA simulation)
     * POST /api/v1/payments/simulate/{orderId}
     */
    public function simulate(Request $request, $orderId)
    {
        $payment = Payment::where('order_id', $orderId)->first();

        if (!$payment) {
            // Create fallback payment if not found
            $user = $request->user();
            $payment = Payment::create([
                'order_id' => $orderId,
                'user_id' => $user ? $user->id : 1,
                'member_name' => $user ? $user->name : 'Budi Pratama Member',
                'member_phone' => '0812-3456-7890',
                'member_email' => $user ? $user->email : 'member@fitlife.id',
                'package_name' => 'VIP Pass Gym Membership 1 Bulan',
                'gross_amount' => 400000,
                'discount_amount' => 50000,
                'net_amount' => 400000,
                'payment_type' => 'qris',
                'payment_method_detail' => 'QRIS Instant Scan',
                'transaction_status' => 'settlement',
                'snap_token' => 'SNAP-' . md5($orderId),
                'paid_at' => now(),
            ]);
        } else {
            $payment->transaction_status = 'settlement';
            $payment->paid_at = now();
            $payment->save();
        }

        // Auto approve user membership & sessions
        if ($payment->user_id) {
            $user = User::find($payment->user_id);
            if ($user) {
                $user->remaining_sessions = ($user->remaining_sessions ?? 0) + 12;
                $user->total_sessions = ($user->total_sessions ?? 0) + 12;
                $user->status = 'ACTIVE VIP Pass';
                $user->membership_type = $payment->package_name;
                $user->save();
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran BERHASIL! E-Receipt Digital VIP Pass telah terbit.',
            'data' => [
                'order_id' => $payment->order_id,
                'package_name' => $payment->package_name,
                'amount' => $payment->net_amount,
                'payment_method' => strtoupper($payment->payment_type),
                'transaction_status' => 'settlement',
                'paid_at' => $payment->paid_at ? $payment->paid_at->format('d M Y H:i') : now()->format('d M Y H:i'),
            ]
        ]);
    }

    /**
     * Get transaction payment history
     * GET /api/v1/payments/history
     */
    public function history(Request $request)
    {
        $user = $request->user();
        $userId = $user ? $user->id : 1;

        $payments = Payment::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil riwayat transaksi pembayaran.',
            'data' => $payments,
        ]);
    }
}
