<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminLeaderboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = User::where('role', 'member')->orderBy('reward_points', 'desc');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('member_card_id', 'like', "%{$search}%");
            });
        }

        $members = $query->paginate(15);
        $totalXpSum = User::where('role', 'member')->sum('reward_points');
        $topKing = User::where('role', 'member')->orderBy('reward_points', 'desc')->first();

        return view('admin.leaderboard.index', compact('members', 'totalXpSum', 'topKing', 'search'));
    }

    public function addBonusXp(Request $request, $id)
    {
        $request->validate([
            'bonus_xp' => 'required|integer|min:1',
            'reason' => 'nullable|string',
        ]);

        $user = User::findOrFail($id);
        $user->reward_points = ($user->reward_points ?? 0) + (int) $request->bonus_xp;

        // Auto update badge if high XP
        if ($user->reward_points >= 4500) {
            $user->level_badge = '👑 Gym King';
        } elseif ($user->reward_points >= 3000) {
            $user->level_badge = '🔥 VIP Platinum';
        } elseif ($user->reward_points >= 2000) {
            $user->level_badge = '⚡ Cardio Queen';
        } elseif ($user->reward_points >= 1000) {
            $user->level_badge = '🏋️ Beast Lifter';
        }

        $user->save();

        return redirect()->back()->with('success', 'Bonus +' . number_format($request->bonus_xp) . ' XP berhasil diberikan kepada ' . $user->name . '!');
    }
}
