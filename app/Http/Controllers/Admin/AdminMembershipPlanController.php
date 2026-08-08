<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembershipPlan;
use Illuminate\Support\Str;

class AdminMembershipPlanController extends Controller
{
    public function index(Request $request)
    {
        $plans = MembershipPlan::orderBy('order')->orderBy('created_at', 'desc')->get();

        if ($plans->isEmpty()) {
            $defaultPlans = [
                [
                    'slug' => 'daily-pass',
                    'name' => 'Daily Pass Harian',
                    'category' => 'daily',
                    'duration_days' => 1,
                    'session_count' => null,
                    'price' => 50000,
                    'promo_price' => null,
                    'badge' => '⚡ Akses 1 Hari',
                    'description' => 'Akses bebas 1 hari penuh ke area gym, free weights, cardio, & shower.',
                    'features' => ['Akses Seluruh Alat Gym', 'Free Locker & Water Dispenser', 'Berlaku 1 Hari Penuh'],
                    'order' => 1,
                ],
                [
                    'slug' => 'regular-monthly',
                    'name' => 'Regular Member 1 Bulan',
                    'category' => 'monthly',
                    'duration_days' => 30,
                    'session_count' => null,
                    'price' => 350000,
                    'promo_price' => 299000,
                    'badge' => '🔥 Paling Laris',
                    'description' => 'Akses tak terbatas selama 30 hari ke area gym & fasilitas shower.',
                    'features' => ['Akses Unlimited 30 Hari', 'Free InBody 3D Scan 1x', 'Akses Semua Cabang FitLife'],
                    'order' => 2,
                ],
                [
                    'slug' => 'vip-platinum-3m',
                    'name' => 'VIP Platinum All-Access 3 Bulan',
                    'category' => 'vip',
                    'duration_days' => 90,
                    'session_count' => null,
                    'price' => 950000,
                    'promo_price' => 799000,
                    'badge' => '👑 VIP Premium All-Access',
                    'description' => 'Fasilitas komplit 24 Jam nonstop, semua kelas studio, sauna, dan heated pool.',
                    'features' => ['Akses 24 Jam Nonstop', 'Gratis Semua Kelas Studio Gym', 'Fasilitas Sauna & Heated Pool', 'Free 2 Sesi Personal Trainer'],
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
                    'features' => ['GRATIS Akses Gym Membership 60 Hari', '10 Sesi Pendampingan 1-on-1 Trainer', 'Program Latihan & Nutrisi Custom', 'Evaluasi & InBody Scan Gratis'],
                    'order' => 4,
                ],
                [
                    'slug' => 'student-pass',
                    'name' => 'Student Pass (Pelajar/Mahasiswa)',
                    'category' => 'student',
                    'duration_days' => 30,
                    'session_count' => null,
                    'price' => 250000,
                    'promo_price' => 199000,
                    'badge' => '🎓 Diskon Mahasiswa',
                    'description' => 'Paket keanggotaan super hemat khusus pelajar & mahasiswa ber-KTM.',
                    'features' => ['Diskon Spesial KTM Aktif', 'Akses Gym Jam 06.00 - 17.00 WIB', 'Free High-Speed WiFi & Locker'],
                    'order' => 5,
                ],
                [
                    'slug' => 'corporate-grup',
                    'name' => 'Corporate Membership (Grup Karyawan)',
                    'category' => 'corporate',
                    'duration_days' => 30,
                    'session_count' => null,
                    'price' => 275000,
                    'promo_price' => null,
                    'badge' => '🏢 Min. 5 Karyawan',
                    'description' => 'Paket sehat karyawan kantor dengan tarif korporat spesial.',
                    'features' => ['Minimal 5 Karyawan Terdaftar', 'Invoice Penagihan Perusahaan', 'Akses Semua Cabang FitLife'],
                    'order' => 6,
                ],
            ];

            foreach ($defaultPlans as $data) {
                MembershipPlan::create($data);
            }

            $plans = MembershipPlan::orderBy('order')->get();
        }

        return view('admin.membership_plans.index', compact('plans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'category' => 'required|string',
            'duration_days' => 'required|integer|min:1',
            'session_count' => 'nullable|integer',
            'price' => 'required|integer|min:0',
            'promo_price' => 'nullable|integer',
            'badge' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'features_text' => 'nullable|string',
        ]);

        $features = array_filter(array_map('trim', explode("\n", $validated['features_text'] ?? '')));

        MembershipPlan::create([
            'slug' => Str::slug($validated['name']) . '-' . rand(100, 999),
            'name' => $validated['name'],
            'category' => $validated['category'],
            'duration_days' => (int) $validated['duration_days'],
            'session_count' => $validated['session_count'] ? (int) $validated['session_count'] : null,
            'price' => (int) $validated['price'],
            'promo_price' => $validated['promo_price'] ? (int) $validated['promo_price'] : null,
            'badge' => $validated['badge'] ?? null,
            'description' => $validated['description'] ?? null,
            'features' => $features ?: ['Akses Gym', 'Locker Room'],
            'is_active' => true,
            'order' => 0,
        ]);

        return redirect()->back()->with('success', 'Paket keanggotaan baru "' . $validated['name'] . '" berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $plan = MembershipPlan::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'category' => 'required|string',
            'duration_days' => 'required|integer|min:1',
            'session_count' => 'nullable|integer',
            'price' => 'required|integer|min:0',
            'promo_price' => 'nullable|integer',
            'badge' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'features_text' => 'nullable|string',
        ]);

        $features = array_filter(array_map('trim', explode("\n", $validated['features_text'] ?? '')));

        $plan->update([
            'name' => $validated['name'],
            'category' => $validated['category'],
            'duration_days' => (int) $validated['duration_days'],
            'session_count' => $validated['session_count'] ? (int) $validated['session_count'] : null,
            'price' => (int) $validated['price'],
            'promo_price' => $validated['promo_price'] ? (int) $validated['promo_price'] : null,
            'badge' => $validated['badge'] ?? null,
            'description' => $validated['description'] ?? null,
            'features' => $features ?: $plan->features,
        ]);

        return redirect()->back()->with('success', 'Paket keanggotaan "' . $plan->name . '" berhasil diperbarui!');
    }

    public function toggleActive($id)
    {
        $plan = MembershipPlan::findOrFail($id);
        $plan->is_active = !$plan->is_active;
        $plan->save();

        $statusStr = $plan->is_active ? 'Diaktifkan' : 'Dinonaktifkan';
        return redirect()->back()->with('success', 'Status paket "' . $plan->name . '" berhasil ' . $statusStr . '!');
    }

    public function destroy($id)
    {
        $plan = MembershipPlan::findOrFail($id);
        $plan->delete();

        return redirect()->back()->with('success', 'Paket keanggotaan berhasil dihapus.');
    }
}
