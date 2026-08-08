<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembershipPlan;

class MembershipPlanApiController extends Controller
{
    /**
     * Get Active Membership Plans Catalog
     * GET /api/v1/membership-plans
     */
    public function index(Request $request)
    {
        $dbPlans = MembershipPlan::where('is_active', true)->orderBy('order')->get();

        if ($dbPlans->isEmpty()) {
            $plans = [
                [
                    'id' => 1,
                    'slug' => 'daily-pass',
                    'name' => 'Daily Pass Harian',
                    'category' => 'daily',
                    'category_label' => 'Harian / Incidental',
                    'duration_days' => 1,
                    'session_count' => null,
                    'price' => 50000,
                    'promo_price' => null,
                    'price_formatted' => 'Rp 50.000',
                    'promo_price_formatted' => null,
                    'badge' => '⚡ Akses 1 Hari',
                    'description' => 'Akses bebas 1 hari penuh ke area gym, free weights, cardio, & shower.',
                    'features' => ['Akses Seluruh Alat Gym', 'Free Locker & Water Dispenser', 'Berlaku 1 Hari Penuh'],
                ],
                [
                    'id' => 2,
                    'slug' => 'regular-monthly',
                    'name' => 'Regular Member 1 Bulan',
                    'category' => 'monthly',
                    'category_label' => 'Regular Fitness',
                    'duration_days' => 30,
                    'session_count' => null,
                    'price' => 350000,
                    'promo_price' => 299000,
                    'price_formatted' => 'Rp 350.000',
                    'promo_price_formatted' => 'Rp 299.000',
                    'badge' => '🔥 Paling Laris',
                    'description' => 'Akses tak terbatas selama 30 hari ke area gym & fasilitas shower.',
                    'features' => ['Akses Unlimited 30 Hari', 'Free InBody 3D Scan 1x', 'Akses Semua Cabang FitLife'],
                ],
                [
                    'id' => 3,
                    'slug' => 'vip-platinum-3m',
                    'name' => 'VIP Platinum All-Access 3 Bulan',
                    'category' => 'vip',
                    'category_label' => 'VIP Premium',
                    'duration_days' => 90,
                    'session_count' => null,
                    'price' => 950000,
                    'promo_price' => 799000,
                    'price_formatted' => 'Rp 950.000',
                    'promo_price_formatted' => 'Rp 799.000',
                    'badge' => '👑 VIP Premium All-Access',
                    'description' => 'Fasilitas komplit 24 Jam nonstop, semua kelas studio, sauna, dan heated pool.',
                    'features' => ['Akses 24 Jam Nonstop', 'Gratis Semua Kelas Studio Gym', 'Fasilitas Sauna & Heated Pool', 'Free 2 Sesi Personal Trainer'],
                ],
                [
                    'id' => 4,
                    'slug' => 'pt-private-10',
                    'name' => 'Personal Trainer 1-on-1 (10 Sesi)',
                    'category' => 'pt_private',
                    'category_label' => 'Privat Personal Trainer',
                    'duration_days' => 60,
                    'session_count' => 10,
                    'price' => 1500000,
                    'promo_price' => 1250000,
                    'price_formatted' => 'Rp 1.500.000',
                    'promo_price_formatted' => 'Rp 1.250.000',
                    'badge' => '🏋️ Free Gym Membership + 10 Sesi PT',
                    'description' => 'Paket All-Inclusive: 10 Sesi privat Personal Trainer APKI + GRATIS Akses Gym Membership 60 Hari.',
                    'features' => ['GRATIS Akses Gym Membership 60 Hari', '10 Sesi Pendampingan 1-on-1 Trainer', 'Program Latihan & Nutrisi Custom', 'Evaluasi & InBody Scan Gratis'],
                ],
                [
                    'id' => 5,
                    'slug' => 'student-pass',
                    'name' => 'Student Pass (Pelajar/Mahasiswa)',
                    'category' => 'student',
                    'category_label' => 'Khusus Mahasiswa',
                    'duration_days' => 30,
                    'session_count' => null,
                    'price' => 250000,
                    'promo_price' => 199000,
                    'price_formatted' => 'Rp 250.000',
                    'promo_price_formatted' => 'Rp 199.000',
                    'badge' => '🎓 Diskon Mahasiswa',
                    'description' => 'Paket keanggotaan super hemat khusus pelajar & mahasiswa ber-KTM.',
                    'features' => ['Diskon Spesial KTM Aktif', 'Akses Gym Jam 06.00 - 17.00 WIB', 'Free High-Speed WiFi & Locker'],
                ],
                [
                    'id' => 6,
                    'slug' => 'corporate-grup',
                    'name' => 'Corporate Membership (Grup Karyawan)',
                    'category' => 'corporate',
                    'category_label' => 'Corporate Company',
                    'duration_days' => 30,
                    'session_count' => null,
                    'price' => 275000,
                    'promo_price' => null,
                    'price_formatted' => 'Rp 275.000 / orang',
                    'promo_price_formatted' => null,
                    'badge' => '🏢 Min. 5 Karyawan',
                    'description' => 'Paket sehat karyawan kantor dengan tarif korporat spesial.',
                    'features' => ['Minimal 5 Karyawan Terdaftar', 'Invoice Penagihan Perusahaan', 'Akses Semua Cabang FitLife'],
                ],
            ];
        } else {
            $plans = $dbPlans->map(function ($plan) {
                return [
                    'id' => $plan->id,
                    'slug' => $plan->slug,
                    'name' => $plan->name,
                    'category' => $plan->category,
                    'category_label' => ucfirst($plan->category),
                    'duration_days' => $plan->duration_days,
                    'session_count' => $plan->session_count,
                    'price' => $plan->price,
                    'promo_price' => $plan->promo_price,
                    'price_formatted' => $plan->formatted_price,
                    'promo_price_formatted' => $plan->formatted_promo_price,
                    'badge' => $plan->badge,
                    'description' => $plan->description,
                    'features' => is_array($plan->features) ? $plan->features : ['Akses Gym', 'Locker Room'],
                ];
            });
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil daftar Paket Keanggotaan Gym Fleksibel.',
            'total_plans' => count($plans),
            'categories' => [
                'all' => 'Semua Paket',
                'daily' => 'Daily Pass',
                'monthly' => 'Regular Bulanan',
                'vip' => 'VIP All-Access',
                'pt_private' => 'Personal Trainer Sesi',
                'student' => 'Pelajar / Mahasiswa',
                'corporate' => 'Corporate Pass',
            ],
            'data' => $plans,
        ]);
    }
}
