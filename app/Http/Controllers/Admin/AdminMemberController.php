<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Coach;
use App\Models\Location;
use App\Models\MembershipPlan;
use App\Models\Program;
use Illuminate\Http\Request;

class AdminMemberController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->input('q'));
        $query = User::where('role', 'member')->orWhereNull('role');

        if ($q) {
            $query->where(function($builder) use ($q) {
                $builder->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%")
                    ->orWhere('member_card_id', 'like', "%{$q}%");
            });
        }

        $members = $query->orderByDesc('created_at')->paginate(15);
        $totalMembers = User::where('role', 'member')->count();
        $totalActiveSessions = User::where('role', 'member')->sum('remaining_sessions');

        return view('admin.members.index', compact('members', 'q', 'totalMembers', 'totalActiveSessions'));
    }

    public function create()
    {
        try {
            $coaches = Coach::active()->ordered()->get();
        } catch (\Exception $e) {
            $coaches = collect();
        }

        try {
            $branches = Location::all();
        } catch (\Exception $e) {
            $branches = collect();
        }

        try {
            $membershipPlans = MembershipPlan::where('is_active', true)->orderBy('order', 'asc')->get();
            if ($membershipPlans->isEmpty()) {
                $membershipPlans = MembershipPlan::all();
            }
        } catch (\Exception $e) {
            $membershipPlans = collect();
        }

        try {
            $programs = Program::orderBy('order', 'asc')->get();
        } catch (\Exception $e) {
            $programs = collect();
        }

        return view('admin.members.create', compact('coaches', 'branches', 'membershipPlans', 'programs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:30',
            'password' => 'nullable|string|min:6',
            'membership_type' => 'required|string',
            'membership_expires_at' => 'nullable|date',
            'membership_price' => 'nullable|numeric',
            'payment_method' => 'nullable|string',
            'status' => 'required|string',
            'branch' => 'nullable|string',
            'remaining_sessions' => 'nullable|integer|min:0',
            'assigned_coach' => 'nullable|string',
            'initial_weight' => 'nullable|numeric',
            'target_weight' => 'nullable|numeric',
        ]);

        $lastUser = User::orderBy('id', 'desc')->first();
        $nextId = $lastUser ? ($lastUser->id + 1) : 1;
        $memberCardId = 'FL-MEM-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        $memberData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => \Illuminate\Support\Facades\Hash::make($validated['password'] ?: '12345678'),
            'role' => 'member',
            'member_card_id' => $memberCardId,
            'membership_type' => $validated['membership_type'],
            'membership_price' => $validated['membership_price'] ?? null,
            'payment_method' => $validated['payment_method'] ?? 'Cash (Tunai)',
            'status' => $validated['status'],
            'branch' => $validated['branch'] ?? 'Sleman HQ (Jl. Kaliurang)',
            'remaining_sessions' => (int) ($validated['remaining_sessions'] ?? 0),
            'total_sessions' => (int) ($validated['remaining_sessions'] ?? 0),
            'assigned_coach' => $validated['assigned_coach'] ?? null,
            'initial_weight' => $validated['initial_weight'] ?? null,
            'current_weight' => $validated['initial_weight'] ?? null,
            'target_weight' => $validated['target_weight'] ?? null,
            'reward_points' => 50,
            'level_badge' => '🔥 Regular Member',
            'streak_days' => 1,
        ];

        try {
            if (!empty($validated['membership_expires_at']) && \Illuminate\Support\Facades\Schema::hasColumn('users', 'membership_expires_at')) {
                $memberData['membership_expires_at'] = $validated['membership_expires_at'];
            }
        } catch (\Exception $e) {}

        $member = User::create($memberData);

        return redirect()->route('admin.members.index')
            ->with('success', 'Akun member baru "' . $member->name . '" (ID Card: ' . $memberCardId . ') BERHASIL DIDAFTARKAN!');
    }

    public function edit($id)
    {
        $member = User::findOrFail($id);
        try {
            $coaches = Coach::active()->ordered()->get();
        } catch (\Exception $e) {
            $coaches = collect();
        }

        try {
            $branches = Location::all();
        } catch (\Exception $e) {
            $branches = collect();
        }

        try {
            $membershipPlans = MembershipPlan::where('is_active', true)->orderBy('order', 'asc')->get();
            if ($membershipPlans->isEmpty()) {
                $membershipPlans = MembershipPlan::all();
            }
        } catch (\Exception $e) {
            $membershipPlans = collect();
        }

        try {
            $programs = Program::orderBy('order', 'asc')->get();
        } catch (\Exception $e) {
            $programs = collect();
        }

        return view('admin.members.edit', compact('member', 'coaches', 'branches', 'membershipPlans', 'programs'));
    }

    public function update(Request $request, $id)
    {
        $member = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $member->id,
            'phone' => 'nullable|string|max:30',
            'membership_type' => 'required|string',
            'membership_expires_at' => 'nullable|date',
            'membership_price' => 'nullable|numeric',
            'payment_method' => 'nullable|string',
            'status' => 'required|string',
            'branch' => 'nullable|string',
            'remaining_sessions' => 'required|integer|min:0',
            'topup_sessions' => 'nullable|integer|min:0',
            'assigned_coach' => 'nullable|string',
            'next_session' => 'nullable|string',
            'initial_weight' => 'nullable|numeric',
            'current_weight' => 'nullable|numeric',
            'target_weight' => 'nullable|numeric',
            'reward_points' => 'nullable|integer',
            'level_badge' => 'nullable|string',
            'streak_days' => 'nullable|integer',
            'current_bodyfat' => 'nullable|numeric',
            'muscle_mass' => 'nullable|numeric',
        ]);

        $topup = (int) $request->input('topup_sessions', 0);
        $newRemaining = (int) $validated['remaining_sessions'] + $topup;

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'membership_type' => $validated['membership_type'],
            'membership_price' => $validated['membership_price'] ?? $member->membership_price,
            'payment_method' => $validated['payment_method'] ?? $member->payment_method,
            'status' => $validated['status'],
            'branch' => $validated['branch'] ?? $member->branch,
            'remaining_sessions' => $newRemaining,
            'total_sessions' => max((int) $member->total_sessions, $newRemaining),
            'assigned_coach' => $validated['assigned_coach'],
            'initial_weight' => $validated['initial_weight'] ?? $member->initial_weight,
            'current_weight' => $validated['current_weight'] ?? $member->current_weight,
            'target_weight' => $validated['target_weight'] ?? $member->target_weight,
            'reward_points' => $validated['reward_points'] ?? $member->reward_points,
            'level_badge' => $validated['level_badge'] ?? $member->level_badge,
            'streak_days' => $validated['streak_days'] ?? $member->streak_days,
            'current_bodyfat' => $validated['current_bodyfat'] ?? $member->current_bodyfat,
            'muscle_mass' => $validated['muscle_mass'] ?? $member->muscle_mass,
        ];

        try {
            if (!empty($validated['membership_expires_at']) && \Illuminate\Support\Facades\Schema::hasColumn('users', 'membership_expires_at')) {
                $updateData['membership_expires_at'] = $validated['membership_expires_at'];
            }
        } catch (\Exception $e) {}

        $member->update($updateData);

        return redirect()->route('admin.members.index')
            ->with('success', 'Data member "' . $member->name . '" & Kuota Sesi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $member = User::findOrFail($id);
        $name = $member->name;
        $member->delete();

        return redirect()->route('admin.members.index')
            ->with('success', 'Akun member "' . $name . '" telah dihapus dari sistem.');
    }
}
