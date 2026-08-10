<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\MembershipPlan;

if (MembershipPlan::count() === 0) {
    $plans = [
        [
            'slug' => 'daily-pass',
            'name' => 'Daily Pass Harian',
            'category' => 'daily',
            'duration_days' => 1,
            'session_count' => 1,
            'price' => 50000,
            'promo_price' => null,
            'badge' => '⚡ Akses 1 Hari',
            'description' => 'Akses bebas 1 hari penuh ke area gym, free weights, cardio, & shower.',
            'features' => json_encode(['Akses Seluruh Alat Gym', 'Free Locker & Water Dispenser', 'Berlaku 1 Hari Penuh']),
            'is_active' => true,
            'order' => 1,
        ],
        [
            'slug' => 'regular-monthly',
            'name' => 'Regular Member 1 Bulan',
            'category' => 'monthly',
            'duration_days' => 30,
            'session_count' => 0,
            'price' => 350000,
            'promo_price' => 299000,
            'badge' => '🔥 Paling Laris',
            'description' => 'Akses tak terbatas selama 30 hari ke area gym & fasilitas shower.',
            'features' => json_encode(['Akses Unlimited 30 Hari', 'Free InBody 3D Scan 1x', 'Akses Semua Cabang FitLife']),
            'is_active' => true,
            'order' => 2,
        ],
        [
            'slug' => 'vip-platinum-3m',
            'name' => 'VIP Platinum All-Access 3 Bulan',
            'category' => 'vip',
            'duration_days' => 90,
            'session_count' => 0,
            'price' => 950000,
            'promo_price' => 799000,
            'badge' => '👑 VIP Premium All-Access',
            'description' => 'Fasilitas komplit 24 Jam nonstop, semua kelas studio, sauna, dan heated pool.',
            'features' => json_encode(['Akses 24 Jam Nonstop', 'Gratis Semua Kelas Studio Gym', 'Fasilitas Sauna & Heated Pool', 'Free 2 Sesi Personal Trainer']),
            'is_active' => true,
            'order' => 3,
        ],
        [
            'slug' => 'pt-private-10',
            'name' => 'Personal Trainer 1-on-1 (10 Sesi)',
            'category' => 'pt_private',
            'duration_days' => 60,
            'session_count' => 10,
            'price' => 1500000,
            'promo_price' => 1250000,
            'badge' => '🏋️ Free Gym Membership + 10 Sesi PT',
            'description' => 'Paket All-Inclusive: 10 Sesi privat Personal Trainer APKI + GRATIS Akses Gym Membership 60 Hari.',
            'features' => json_encode(['GRATIS Akses Gym Membership 60 Hari', '10 Sesi Pendampingan 1-on-1 Trainer', 'Program Latihan & Nutrisi Custom', 'Evaluasi & InBody Scan Gratis']),
            'is_active' => true,
            'order' => 4,
        ],
        [
            'slug' => 'student-pass',
            'name' => 'Student Pass (Pelajar/Mahasiswa)',
            'category' => 'student',
            'duration_days' => 30,
            'session_count' => 0,
            'price' => 250000,
            'promo_price' => 199000,
            'badge' => '🎓 Diskon Mahasiswa',
            'description' => 'Paket keanggotaan super hemat khusus pelajar & mahasiswa ber-KTM.',
            'features' => json_encode(['Diskon Spesial KTM Aktif', 'Akses Gym Jam 06.00 - 17.00 WIB', 'Free High-Speed WiFi & Locker']),
            'is_active' => true,
            'order' => 5,
        ],
    ];

    foreach ($plans as $p) {
        MembershipPlan::create($p);
    }
}

echo "SUCCESS! Total Membership Plans in DB: " . MembershipPlan::count() . "\n";
