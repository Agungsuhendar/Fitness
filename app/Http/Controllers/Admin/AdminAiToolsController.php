<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AdminAiToolsController extends Controller
{
    public function churnIndex()
    {
        $members = User::where('role', 'member')->orWhereNull('role')->get();

        $churnAnalysis = $members->map(function($user) {
            $lastAttendance = Attendance::where('user_id', $user->id)
                ->orWhere('member_card_id', $user->member_card_id)
                ->orderByDesc('checkin_time')
                ->first();

            $daysInactive = $lastAttendance ? (int) $lastAttendance->checkin_time->diffInDays(now()) : rand(7, 21);
            
            if ($daysInactive >= 14) {
                $riskScore = 90;
                $riskLabel = 'TINGGI (CRITICAL)';
                $color = '#ef4444';
            } elseif ($daysInactive >= 7) {
                $riskScore = 65;
                $riskLabel = 'SEDANG (WARNING)';
                $color = '#eab308';
            } else {
                $riskScore = 15;
                $riskLabel = 'RENDAH (LOVIAL)';
                $color = '#16a34a';
            }

            return (object)[
                'user' => $user,
                'days_inactive' => $daysInactive,
                'risk_score' => $riskScore,
                'risk_label' => $riskLabel,
                'color' => $color,
                'last_checkin' => $lastAttendance ? $lastAttendance->checkin_time->format('d M Y, H:i') : 'Belum Pernah Check-in',
                'recommended_message' => "Halo Kak *{$user->name}*, kami rindu melihat Anda berlatih di FitLife Studio! Sisa kuota PT Anda saat ini masih tersisa *{$user->remaining_sessions} sesi*. Yuk kembali latihan pekan ini!",
            ];
        })->sortByDesc('risk_score');

        return view('admin.ai_churn.index', compact('churnAnalysis'));
    }

    public function copywriterIndex()
    {
        return view('admin.ai_copywriter.index');
    }

    public function generateCopy(Request $request)
    {
        $validated = $request->validate([
            'promo_name' => 'required|string|max:255',
            'target_audience' => 'required|string',
            'discount_value' => 'required|string',
        ]);

        $name = $validated['promo_name'];
        $audience = $validated['target_audience'];
        $discount = $validated['discount_value'];

        $copies = [
            'wa_broadcast' => "🔥 *SPECIAL PROMO: {$name}!* 🔥\n\nHalo Sahabat FitLife Jogja! Khusus untuk *{$audience}*, dapatkan promo diskon spesial *{$discount}* pekan ini!\n\n💪 *Mengapa Harus FitLife Center?*\n• Alat Gym Lengkap & Ruang Ber-AC\n• Personal Trainer Bimbingan 1-on-1 Bergaransi\n• Presensi Kiosk QR Code Praktis\n\n🎟️ *Klaim Voucher Promo Anda Sekarang:* " . url('/harga') . "\n\n_Salam Sehat, FitLife Center Team_",
            
            'ig_caption' => "🎯 WANNA GET FIT & SHAPED THIS MONTH? 💥\n\nKhusus kamu yang {$audience}, nikmati promo eksklusif *{$name}* dengan potongan *{$discount}*!\n\n🏋️ Bimbingan Personal Trainer 1-on-1 privat bergaransi cepat bisa.\n📍 Lokasi: Sleman HQ (Jl. Kaliurang), Seturan & Bantul.\n\n👇 Klik link di bio untuk klaim voucher kamu sebelum kuota habis!\n\n#GymJogja #FitLifeCenter #FitnessJogja #PersonalTrainerJogja #InfoJogja",
            
            'tiktok_hook' => "🔥 *[POV: Kamu Mau Turun 5kg Tapi Bingung Mulai Darimana?]* 🔥\n\nKabar gembira buat warga Jogja! Lagi ada promo *{$name}* diskon *{$discount}* khusus buat {$audience}!\n\nCek profil & klik link bio sekarang untuk gratis trial 1x sesi PT!"
        ];

        return response()->json([
            'success' => true,
            'copies' => $copies,
        ]);
    }
}
