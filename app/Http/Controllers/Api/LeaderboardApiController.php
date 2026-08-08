<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LeaderboardApiController extends Controller
{
    /**
     * Get Leaderboard Rankings, Achievements & Redeemable Rewards Catalog
     * GET /api/v1/leaderboard
     */
    public function index(Request $request)
    {
        $currentUser = $request->user();
        $currentUserId = $currentUser ? $currentUser->id : 1;

        // Fetch Top Ranked Members from Database
        $topMembers = User::where('role', 'member')
            ->orderBy('reward_points', 'desc')
            ->take(10)
            ->get();

        // Seed default leaderboard entries if database is empty/new
        if ($topMembers->isEmpty()) {
            $rankings = [
                [
                    'rank' => 1,
                    'id' => 99,
                    'name' => 'Daffa Pratama',
                    'points' => 4850,
                    'points_formatted' => '4,850 XP',
                    'checkins' => '32 Check-in',
                    'badge' => '👑 Gym King',
                    'is_user' => false,
                ],
                [
                    'rank' => 2,
                    'id' => $currentUserId,
                    'name' => $currentUser ? $currentUser->name . ' (Anda)' : 'Bima Sakti (Anda)',
                    'points' => $currentUser ? ($currentUser->reward_points ?: 3450) : 3450,
                    'points_formatted' => number_format($currentUser ? ($currentUser->reward_points ?: 3450) : 3450) . ' XP',
                    'checkins' => '24 Check-in',
                    'badge' => '🔥 VIP Platinum',
                    'is_user' => true,
                ],
                [
                    'rank' => 3,
                    'id' => 98,
                    'name' => 'Siti Rahmawati',
                    'points' => 3100,
                    'points_formatted' => '3,100 XP',
                    'checkins' => '22 Check-in',
                    'badge' => '⚡ Cardio Queen',
                    'is_user' => false,
                ],
                [
                    'rank' => 4,
                    'id' => 97,
                    'name' => 'Rian Hidayat',
                    'points' => 2850,
                    'points_formatted' => '2,850 XP',
                    'checkins' => '20 Check-in',
                    'badge' => '🏋️ Beast Lifter',
                    'is_user' => false,
                ],
                [
                    'rank' => 5,
                    'id' => 96,
                    'name' => 'Anisa Putri',
                    'points' => 2400,
                    'points_formatted' => '2,400 XP',
                    'checkins' => '18 Check-in',
                    'badge' => '🧘 Yoga Master',
                    'is_user' => false,
                ],
            ];
        } else {
            $rankings = $topMembers->map(function ($user, $index) use ($currentUserId) {
                return [
                    'rank' => $index + 1,
                    'id' => $user->id,
                    'name' => $user->id === $currentUserId ? $user->name . ' (Anda)' : $user->name,
                    'points' => $user->reward_points ?? 50,
                    'points_formatted' => number_format($user->reward_points ?? 50) . ' XP',
                    'checkins' => ($user->completed_sessions ?? 12) . ' Check-in',
                    'badge' => $user->level_badge ?? '🔥 VIP Platinum',
                    'is_user' => $user->id === $currentUserId,
                ];
            });
        }

        $userPoints = $currentUser ? ($currentUser->reward_points ?: 3450) : 3450;
        $userStreak = $currentUser ? ($currentUser->streak_days ?: 14) : 14;

        $achievements = [
            [
                'id' => 1,
                'title' => '100 Days Gym Warrior',
                'desc' => 'Total kedatangan gym mencapai 100 kali dalam setahun.',
                'icon' => 'emoji_events',
                'color' => 'goldAccent',
                'isUnlocked' => true,
                'progress' => 1.0,
            ],
            [
                'id' => 2,
                'title' => 'Heavy Lifter 100KG',
                'desc' => 'Berhasil mengangkat beban 100KG pada gerakan Bench/Squat.',
                'icon' => 'fitness_center',
                'color' => 'limePrimary',
                'isUnlocked' => true,
                'progress' => 1.0,
            ],
            [
                'id' => 3,
                'title' => 'Early Bird 06.00 WIB',
                'desc' => 'Check-in sesi gym pagi hari sebelum jam 07.00 WIB sebanyak 10x.',
                'icon' => 'wb_sunny',
                'color' => 'cyanAccent',
                'isUnlocked' => false,
                'progress' => 0.6,
            ],
            [
                'id' => 4,
                'title' => 'Iron Muscle Titan',
                'desc' => 'Menyelesaikan 50 sesi latihan 1-on-1 bersama Personal Trainer.',
                'icon' => 'shield',
                'color' => 'purpleAccent',
                'isUnlocked' => false,
                'progress' => 0.8,
            ],
        ];

        $rewards = [
            [
                'id' => 1,
                'title' => 'FitLife Shaker Bottle Neon',
                'cost' => 800,
                'category' => 'Merchandise',
                'icon' => 'local_drink',
                'color' => 'limePrimary',
            ],
            [
                'id' => 2,
                'title' => 'Whey Protein Gold 1-Serving',
                'cost' => 1200,
                'category' => 'Suplemen Gym',
                'icon' => 'flash_on',
                'color' => 'cyanAccent',
            ],
            [
                'id' => 3,
                'title' => 'T-Shirt FitLife Exclusive',
                'cost' => 2500,
                'category' => 'Apparel',
                'icon' => 'checkroom',
                'color' => 'purpleAccent',
            ],
            [
                'id' => 4,
                'title' => 'Voucher Free 2 Sesi PT',
                'cost' => 3500,
                'category' => 'VIP Pass Bonus',
                'icon' => 'workspace_premium',
                'color' => 'goldAccent',
            ],
        ];

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data klasemen Leaderboard XP & Rewards.',
            'user_stats' => [
                'user_points' => $userPoints,
                'streak_days' => $userStreak,
                'rank' => 2,
                'badge' => $currentUser->level_badge ?? '🔥 VIP Platinum',
            ],
            'rankings' => $rankings,
            'achievements' => $achievements,
            'rewards' => $rewards,
        ]);
    }

    /**
     * Redeem Rewards using XP points
     * POST /api/v1/leaderboard/redeem
     */
    public function redeem(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'title' => 'required|string',
            'cost' => 'required|integer|min:1',
        ]);

        $cost = (int) $validated['cost'];
        $title = $validated['title'];

        if ($user) {
            if (($user->reward_points ?? 3450) < $cost) {
                return response()->json([
                    'success' => false,
                    'message' => 'Poin Anda tidak mencukupi untuk klaim hadiah ' . $title . '.',
                ], 400);
            }

            $user->reward_points = max(0, ($user->reward_points ?? 3450) - $cost);
            $user->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Selamat! Anda telah menukarkan ' . number_format($cost) . ' Poin untuk "' . $title . '". Silakan ambil merchandise di Resepsionis Gym FitLife.',
            'remaining_points' => $user ? $user->reward_points : 2250,
        ]);
    }
}
