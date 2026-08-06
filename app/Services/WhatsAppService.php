<?php

namespace App\Services;

use App\Models\User;
use App\Models\Payment;
use App\Models\Attendance;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    /**
     * Send WhatsApp notification via API Gateway (Fonnte/Wablas/Twilio)
     */
    public static function sendMessage(string $targetPhone, string $message): bool
    {
        $cleanPhone = preg_replace('/[^0-9]/', '', $targetPhone);
        if (str_starts_with($cleanPhone, '0')) {
            $cleanPhone = '62' . substr($cleanPhone, 1);
        }

        $apiKey = \App\Models\Setting::get('wa_api_key', env('WA_API_KEY', 'demo_wa_api_key_fitlife'));
        $endpoint = \App\Models\Setting::get('wa_api_endpoint', env('WA_API_ENDPOINT', 'https://api.fonnte.com/send'));

        try {
            $response = Http::withHeaders([
                'Authorization' => $apiKey,
            ])->post($endpoint, [
                'target' => $cleanPhone,
                'message' => $message,
            ]);

            Log::info("WhatsApp Service Sent to {$cleanPhone}: " . ($response->successful() ? 'SUCCESS' : 'FAILED'));
            return $response->successful();
        } catch (\Exception $e) {
            Log::error("WhatsApp Service Error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Send Welcome Notification on Member Registration
     */
    public static function sendWelcomeNotification(User $user): bool
    {
        $msg = "🎉 *Selamat Datang di FitLife Center Jogja!*%0A%0A"
            . "Halo Kak *{$user->name}*, akun member Anda telah aktif.%0A%0A"
            . "🆔 *ID Member:* `{$user->member_card_id}`%0A"
            . "🏋️ *Paket:* {$user->membership_type}%0A"
            . "📊 *Sisa Sesi PT:* {$user->remaining_sessions} Sesi%0A%0A"
            . "Silakan login ke Portal Member di " . url('/login') . " untuk memantau jadwal & statistik latihan Anda.%0A%0A"
            . "_FitLife Center Jogja - Health & Fitness Hub_";

        return self::sendMessage($user->phone, urldecode($msg));
    }

    /**
     * Send E-Receipt Notification on Midtrans Payment Settlement
     */
    public static function sendPaymentReceiptNotification(Payment $payment): bool
    {
        $msg = "⚡ *KWITANSI PEMBAYARAN RESMI (LUNAS)*%0A%0A"
            . "Terima kasih Kak *{$payment->member_name}*, pembayaran Anda telah terkonfirmasi otomatis via Midtrans!%0A%0A"
            . "🧾 *No. Order:* `{$payment->order_id}`%0A"
            . "📦 *Paket:* {$payment->package_name}%0A"
            . "💰 *Total Lunas:* Rp " . number_format($payment->net_amount, 0, ',', '.') . "%0A"
            . "💳 *Metode:* {$payment->payment_method_detail}%0A%0A"
            . "Lihat e-Receipt resmi Anda di: " . url('/invoice?order_id=' . $payment->order_id) . "%0A%0A"
            . "_FitLife Center Jogja Finance Dept_";

        return self::sendMessage($payment->member_phone, urldecode($msg));
    }

    /**
     * Send Attendance Check-in Notification
     */
    public static function sendCheckinNotification(User $user, Attendance $attendance): bool
    {
        $msg = "🏋️ *NOTIFIKASI PRESENSI FITLIFE STUDIO*%0A%0A"
            . "Halo Kak *{$user->name}*, check-in studio Anda berhasil!%0A%0A"
            . "📍 *Lokasi:* {$attendance->branch}%0A"
            . "⏰ *Waktu:* {$attendance->checkin_time->format('d M Y, H:i:s')}%0A"
            . "⚡ *Pemotongan:* {$attendance->pt_deducted}%0A"
            . "📊 *Sisa Sesi Tersisa:* {$attendance->remaining_sessions_after} Sesi%0A%0A"
            . "Selamat berlatih & salam sehat! 💪";

        return self::sendMessage($user->phone, urldecode($msg));
    }
}
