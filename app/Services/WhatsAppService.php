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

    /**
     * Send Low Session Warning Notification via WhatsApp
     */
    public static function sendLowSessionNotification(User $user): bool
    {
        $msg = "⚠️ *PERINGATAN SISA KUOTA PT HAMPIR HABIS*%0A%0A"
            . "Halo Kak *{$user->name}*, sisa kuota sesi Personal Trainer Anda saat ini tinggal *{$user->remaining_sessions} Sesi lagi*!%0A%0A"
            . "Agar progres latihan fisik Anda tidak terputus, yuk lakukan Top-Up paket sesi Anda secara instan di: " . url('/harga') . "%0A%0A"
            . "Salam Sehat, FitLife Center Jogja 💪";

        return self::sendMessage($user->phone, urldecode($msg));
    }

    /**
     * Send Membership Expiry Warning Notification (H-7, H-3, H-1 Renewal Alert)
     */
    public static function sendMembershipExpiryWarningNotification(User $user, int $daysRemaining): bool
    {
        $expiryDateStr = $user->membership_expires_at ? $user->membership_expires_at->format('d M Y') : 'segera';
        $renewalUrl = url('/invoice?id=' . ($user->member_card_id ?: $user->id));

        $msg = "⏳ *PENGINGAT PERPANJANGAN KEANGGOTAAN FITLIFE*%0A%0A"
            . "Halo Kak *{$user->name}*, keanggotaan paket FitLife Gym Anda akan berakhir dalam *{$daysRemaining} hari lagi* ({$expiryDateStr})!%0A%0A"
            . "🆔 *ID Member:* `{$user->member_card_id}`%0A"
            . "🏋️ *Paket:* {$user->membership_type}%0A"
            . "📊 *Sisa Sesi PT:* {$user->remaining_sessions} Sesi%0A%0A"
            . "Agar akses studio & progres latihan fisik Anda tidak terputus, yuk perpanjang keanggotaan Anda sekarang secara instan via QRIS/VA: %0A"
            . "🔗 *Link Perpanjangan 1-Klik:* {$renewalUrl}%0A%0A"
            . "Terima kasih & Salam Sehat, FitLife Center Jogja 💪✨";

        return self::sendMessage($user->phone, urldecode($msg));
    }

    /**
     * Send Class Waitlist Promotion Notification via WhatsApp
     */
    public static function sendClassWaitlistPromotionNotification(\App\Models\ClassBooking $booking): bool
    {
        $className = $booking->fitnessClass->name ?? 'Kelas Studio Gym';
        $classTime = $booking->fitnessClass->schedule_time ?? 'Hari Ini';
        $instructor = $booking->fitnessClass->instructor ?? 'Coach Studio';
        $phone = $booking->member_phone ?: ($booking->user->phone ?? '');

        if (!$phone) return false;

        $msg = "🎉 *KABAR GEMBIRA! PROMOSI KELAS STUDIO FITLIFE*%0A%0A"
            . "Halo Kak *{$booking->member_name}*, terdapat pembatalan peserta pada kelas *{$className}*!%0A%0A"
            . "Status antrean Waitlist Anda otomatis *DIPROMOSIKAN menjadi PESERTA RESMI (CONFIRMED)*! 🥳%0A%0A"
            . "📅 *Kelas:* {$className}%0A"
            . "⏰ *Jadwal:* {$classTime}%0A"
            . "🏋️ *Instruktur:* {$instructor}%0A%0A"
            . "Silakan hadir 10 menit sebelum kelas dimulai & tunjukkan QR Card saat masuk studio. Sampai jumpa di kelas! 💪✨";

        return self::sendMessage($phone, urldecode($msg));
    }
}
