<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Locker;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminLockerController extends Controller
{
    public function index(Request $request)
    {
        Locker::ensureTable();
        $this->ensureDefaultSeedLockers();

        $genderFilter = $request->input('gender', 'all');
        $statusFilter = $request->input('status', 'all');
        $q = trim($request->input('q'));

        $query = Locker::orderBy('gender_category')->orderBy('locker_number');

        if ($genderFilter !== 'all') {
            $query->where('gender_category', $genderFilter);
        }

        if ($statusFilter !== 'all') {
            $query->where('status', $statusFilter);
        }

        if ($q) {
            $query->where(function($b) use ($q) {
                $b->where('locker_number', 'like', "%{$q}%")
                  ->orWhere('member_name', 'like', "%{$q}%");
            });
        }

        $lockers = $query->get();

        // Active Members for Manual Assign dropdown
        $activeMembers = User::where('status', 'like', '%Active%')
            ->orWhere('status', 'like', '%LUNAS%')
            ->orderBy('name')
            ->get(['id', 'name', 'member_card_id', 'gender']);

        // Stats
        $totalLockers = Locker::count();
        $occupiedCount = Locker::where('status', 'occupied')->count();
        $availableCount = Locker::where('status', 'available')->count();
        $maintenanceCount = Locker::where('status', 'maintenance')->count();

        return view('admin.lockers.index', compact(
            'lockers', 'genderFilter', 'statusFilter', 'q', 'activeMembers',
            'totalLockers', 'occupiedCount', 'availableCount', 'maintenanceCount'
        ));
    }

    public function store(Request $request)
    {
        Locker::ensureTable();

        $validated = $request->validate([
            'locker_number' => 'required|string|unique:lockers,locker_number',
            'gender_category' => 'required|string|in:male,female,all',
            'notes' => 'nullable|string',
        ]);

        Locker::create($validated);

        return redirect()->route('admin.lockers.index')->with('success', 'Nomor Locker baru "' . $validated['locker_number'] . '" berhasil ditambahkan!');
    }

    public function batchGenerate(Request $request)
    {
        Locker::ensureTable();

        $validated = $request->validate([
            'prefix' => 'required|string|max:10',
            'start_num' => 'required|integer|min:1',
            'count' => 'required|integer|min:1|max:100',
            'gender_category' => 'required|string|in:male,female,all',
        ]);

        $prefix = strtoupper(trim($validated['prefix']));
        $start = (int)$validated['start_num'];
        $count = (int)$validated['count'];
        $genderCat = $validated['gender_category'];

        $createdCount = 0;
        for ($i = 0; $i < $count; $i++) {
            $numStr = $prefix . '-' . str_pad($start + $i, 2, '0', STR_PAD_LEFT);
            if (!Locker::where('locker_number', $numStr)->exists()) {
                Locker::create([
                    'locker_number' => $numStr,
                    'gender_category' => $genderCat,
                    'status' => 'available',
                ]);
                $createdCount++;
            }
        }

        return redirect()->route('admin.lockers.index')->with('success', "Batch Generator berhasil menambahkan {$createdCount} loker baru!");
    }

    public function assign(Request $request)
    {
        Locker::ensureTable();

        $validated = $request->validate([
            'locker_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        $locker = Locker::findOrFail($validated['locker_id']);
        $user = User::findOrFail($validated['user_id']);

        $locker->assignToUser($user);

        return redirect()->route('admin.lockers.index')->with('success', "Loker {$locker->locker_number} berhasil dipinjamkan ke Member {$user->name}!");
    }

    public function release($id)
    {
        Locker::ensureTable();
        $locker = Locker::findOrFail($id);
        $locker->release();

        return redirect()->route('admin.lockers.index')->with('success', "Loker {$locker->locker_number} berhasil dikosongkan & kunci dikembalikan.");
    }

    public function toggleMaintenance($id)
    {
        Locker::ensureTable();
        $locker = Locker::findOrFail($id);

        if ($locker->status === 'maintenance') {
            $locker->status = 'available';
            $msg = "Loker {$locker->locker_number} selesai diperbaiki & kembali Siap Pakai.";
        } else {
            $locker->release();
            $locker->status = 'maintenance';
            $msg = "Status Loker {$locker->locker_number} diubah menjadi Maintenance (Perbaikan).";
        }
        $locker->save();

        return redirect()->route('admin.lockers.index')->with('success', $msg);
    }

    private function ensureDefaultSeedLockers()
    {
        if (Locker::count() === 0) {
            // Seed 10 Lockers Male, 10 Lockers Female, 5 Lockers Unisex
            for ($i = 1; $i <= 10; $i++) {
                Locker::create([
                    'locker_number' => 'M-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                    'gender_category' => 'male',
                    'status' => 'available',
                ]);
            }
            for ($i = 1; $i <= 10; $i++) {
                Locker::create([
                    'locker_number' => 'W-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                    'gender_category' => 'female',
                    'status' => 'available',
                ]);
            }
            for ($i = 1; $i <= 5; $i++) {
                Locker::create([
                    'locker_number' => 'U-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                    'gender_category' => 'all',
                    'status' => 'available',
                ]);
            }
        }
    }
}
