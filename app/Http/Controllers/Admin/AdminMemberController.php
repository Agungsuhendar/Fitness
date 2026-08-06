<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Coach;
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

    public function edit($id)
    {
        $member = User::findOrFail($id);
        try {
            $coaches = Coach::active()->ordered()->get();
        } catch (\Exception $e) {
            $coaches = collect();
        }

        return view('admin.members.edit', compact('member', 'coaches'));
    }

    public function update(Request $request, $id)
    {
        $member = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $member->id,
            'phone' => 'nullable|string|max:30',
            'membership_type' => 'required|string',
            'status' => 'required|string',
            'branch' => 'nullable|string',
            'remaining_sessions' => 'required|integer|min:0',
            'topup_sessions' => 'nullable|integer|min:0',
            'assigned_coach' => 'nullable|string',
            'next_session' => 'nullable|string',
            'initial_weight' => 'nullable|numeric',
            'current_weight' => 'nullable|numeric',
            'target_weight' => 'nullable|numeric',
        ]);

        $topup = (int) $request->input('topup_sessions', 0);
        $newRemaining = (int) $validated['remaining_sessions'] + $topup;

        $member->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'membership_type' => $validated['membership_type'],
            'status' => $validated['status'],
            'branch' => $validated['branch'],
            'remaining_sessions' => $newRemaining,
            'total_sessions' => ($member->total_sessions ?? 0) + $topup,
            'assigned_coach' => $validated['assigned_coach'],
            'next_session' => $validated['next_session'],
            'initial_weight' => $validated['initial_weight'],
            'current_weight' => $validated['current_weight'],
            'target_weight' => $validated['target_weight'],
        ]);

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
