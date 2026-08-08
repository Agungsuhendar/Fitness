<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Str;

class AdminBranchController extends Controller
{
    public function index(Request $request)
    {
        $branches = Location::orderBy('created_at', 'desc')->get();

        if ($branches->isEmpty()) {
            Location::create([
                'slug' => 'fitlife-sleman-hq',
                'name' => 'FitLife Gym Sleman HQ',
                'city' => 'Sleman',
                'address' => 'Jl. Kaliurang Km 5.5 No. 18, Sleman, DIY',
                'hours' => '24 Jam Nonstop',
                'phone' => '0274-556677',
                'current_capacity' => 28,
                'max_capacity' => 80,
                'crowd_status' => 'SEPI (35% Kapasitas)',
                'is_featured' => true,
                'features' => ['Free Weights Arena', 'Kolam Renang Heated', 'Sauna & Locker', 'Juice Bar'],
            ]);

            Location::create([
                'slug' => 'fitlife-seturan-raya',
                'name' => 'FitLife Gym Seturan Raya',
                'city' => 'Depok, Sleman',
                'address' => 'Jl. Seturan Raya No. 45, Caturtunggal, Depok',
                'hours' => '06.00 - 23.00 WIB',
                'phone' => '0274-558899',
                'current_capacity' => 65,
                'max_capacity' => 80,
                'crowd_status' => 'RAMAI (82% Kapasitas)',
                'is_featured' => true,
                'features' => ['Studio Aerobik & Zumba', 'Spinning Cycling Studio', 'Free WiFi High-Speed'],
            ]);

            Location::create([
                'slug' => 'fitlife-ringroad-bantul',
                'name' => 'FitLife Gym Ringroad Bantul',
                'city' => 'Bantul',
                'address' => 'Jl. Ringroad Selatan No. 88, Sewon, Bantul',
                'hours' => '06.00 - 22.00 WIB',
                'phone' => '0274-551122',
                'current_capacity' => 44,
                'max_capacity' => 80,
                'crowd_status' => 'SEDANG (55% Kapasitas)',
                'is_featured' => true,
                'features' => ['Calisthenics Outdoor Park', 'Powerlifting Rig', 'Cafe Protein'],
            ]);

            $branches = Location::orderBy('created_at', 'desc')->get();
        }

        return view('admin.branches.index', compact('branches'));
    }

    public function updateCrowd(Request $request, $id)
    {
        $request->validate([
            'current_capacity' => 'required|integer|min:0',
            'max_capacity' => 'required|integer|min:1',
        ]);

        $branch = Location::findOrFail($id);
        $curr = (int) $request->current_capacity;
        $max = (int) $request->max_capacity;
        $pct = round(($curr / $max) * 100);

        $statusText = $pct >= 80 ? "RAMAI ({$pct}% Kapasitas)" : ($pct >= 50 ? "SEDANG ({$pct}% Kapasitas)" : "SEPI ({$pct}% Kapasitas)");

        $branch->current_capacity = $curr;
        $branch->max_capacity = $max;
        $branch->crowd_status = $statusText;
        $branch->save();

        return redirect()->back()->with('success', 'Live Crowd Meter cabang ' . $branch->name . ' berhasil diperbarui! (' . $statusText . ')');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'hours' => 'nullable|string',
            'phone' => 'nullable|string',
            'max_capacity' => 'required|integer|min:10',
        ]);

        Location::create([
            'slug' => Str::slug($validated['name']),
            'name' => $validated['name'],
            'city' => $validated['city'],
            'address' => $validated['address'],
            'hours' => $validated['hours'] ?? '24 Jam Nonstop',
            'phone' => $validated['phone'] ?? '0274-556677',
            'current_capacity' => 15,
            'max_capacity' => (int) $validated['max_capacity'],
            'crowd_status' => 'SEPI (15% Kapasitas)',
            'is_featured' => true,
            'features' => ['Free Weights Arena', 'Locker Room', 'WiFi High-Speed'],
        ]);

        return redirect()->back()->with('success', 'Cabang gym baru berhasil ditambahkan!');
    }
}
