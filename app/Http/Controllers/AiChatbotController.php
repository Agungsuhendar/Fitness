<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Program;

class AiChatbotController extends Controller
{
    public function ask(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:500',
        ]);

        $message = strtolower(trim($validated['message']));
        $reply = $this->generateBotReply($message);

        return response()->json([
            'success' => true,
            'reply' => $reply['text'],
            'action_button' => $reply['button'] ?? null,
        ]);
    }

    private function generateBotReply($msg)
    {
        $waPhone = Setting::get('whatsapp_number', '6281234567890');

        if (str_contains($msg, 'harga') || str_contains($msg, 'biaya') || str_contains($msg, 'bayar') || str_contains($msg, 'paket')) {
            return [
                'text' => "💪 *INFO PAKET & HARGA FITLIFE JOGJA*\n\n1️⃣ *Paket Harian (Daily Pass):* Rp 35.000 / visit.\n2️⃣ *Membership Bulanan Regular:* Rp 299.000 / bulan (Free akses alat gym & shower).\n3️⃣ *Paket VIP Personal Trainer (12 Sesi):* Rp 2.500.000 (Garansi hasil 1-on-1 + Gratis Nutrisi Plan).\n\n🎟️ *Promo Pekan Ini:* Gunakan kode voucher *FITJOGJA50* untuk potongan Rp 50.000!",
                'button' => [
                    'label' => '👉 Buka Halaman Daftar Harga',
                    'url' => url('/harga')
                ]
            ];
        }

        if (str_contains($msg, 'lokasi') || str_contains($msg, 'alamat') || str_contains($msg, 'dimana') || str_contains($msg, 'sleman') || str_contains($msg, 'ugm') || str_contains($msg, 'kaliurang')) {
            return [
                'text' => "📍 *LOKASI CABANG FITLIFE CENTER JOGJA*\n\n🏢 *Sleman HQ (Main Studio):* Jl. Kaliurang Km 5.5 No. 12, Sleman (Dekat UGM/UNY).\n🏢 *Cabang Seturan:* Jl. Seturan Raya No. 8B, Depok, Sleman.\n🏢 *Cabang Bantul:* Jl. Ringroad Selatan No. 45, Kota Jogja.\n\n⏰ *Jam Operasional:* Buka Setiap Hari (06:00 - 22:00 WIB).",
                'button' => [
                    'label' => '📍 Lihat Peta Lokasi Google Maps',
                    'url' => url('/lokasi')
                ]
            ];
        }

        if (str_contains($msg, 'jadwal') || str_contains($msg, 'jam') || str_contains($msg, 'buka') || str_contains($msg, 'tutup')) {
            return [
                'text' => "⏰ *JAM OPERASIONAL & KELAS STUDIO*\n\n• *Senin - Minggu:* Buka 06:00 - 22:00 WIB\n• *Sesi PT Privat:* Berdasarkan reservasi slot member.\n• *Kelas Kelompok (Yoga, HIIT, Aerobik):* Pagi (07:00 - 08:30) & Sore (16:00 - 17:30 WIB).",
                'button' => [
                    'label' => '📅 Lihat Kalender Jadwal Kelas',
                    'url' => url('/kelas')
                ]
            ];
        }

        if (str_contains($msg, 'daftar') || str_contains($msg, 'registrasi') || str_contains($msg, 'join') || str_contains($msg, 'member')) {
            return [
                'text' => "🎉 *PENDAFTARAN MEMBER / FREE TRIAL GRATIS*\n\nAnda bisa langsung mendaftar secara instan online atau mencoba 1x Sesi Trial Gratis bersama Coach Personal Trainer kami!",
                'button' => [
                    'label' => '🚀 Form Pendaftaran Online Instant',
                    'url' => url('/harga')
                ]
            ];
        }

        if (str_contains($msg, 'pt') || str_contains($msg, 'trainer') || str_contains($msg, 'pelatih') || str_contains($msg, 'wanita') || str_contains($msg, 'tni') || str_contains($msg, 'polri')) {
            return [
                'text' => "🏋️ *PROGRAM TRAINER PRIVAT FITLIFE*\n\nKami melayani bimbingan 1-on-1 bergaransi:\n• Program Fat Loss & Muscle Gain Dewasa Pemula\n• Program Khusus Pelatih Wanita / Muslimah\n• Program Persiapan Fisik Tes TNI/POLRI & Kedinasan\n• Program Rehabilitasi Postur & Cedera ringan.",
                'button' => [
                    'label' => '👨‍🏫 Profil Pelatih Sertifikasi',
                    'url' => url('/pelatih')
                ]
            ];
        }

        // Fallback Default Reply with WA Handoff
        return [
            'text' => "🤖 Halo! Saya *FitBot AI*, asisten cerdas 24/7 FitLife Center Jogja.\n\nSaya bisa membantu memberikan informasi tentang:\n1️⃣ *Harga Paket & Promo Voucher*\n2️⃣ *Lokasi Cabang & Jam Buka*\n3️⃣ *Program Personal Trainer & Kelas Studio*\n\nAda yang bisa saya bantu untuk perjalanan fitness Anda?",
            'button' => [
                'label' => '💬 Chat Langsung dengan Admin WA',
                'url' => "https://wa.me/{$waPhone}?text=" . urlencode("Halo Admin FitLife, saya butuh informasi lebih lanjut.")
            ]
        ];
    }
}
