<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkoutLog;
use App\Models\User;
use Carbon\Carbon;

class WorkoutLogApiController extends Controller
{
    /**
     * Get member's workout history & stats summary
     * GET /api/v1/workout-logs
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $userId = $user ? $user->id : 1;

        $logs = WorkoutLog::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalVolume = $logs->sum('total_volume_kg');
        $totalDurationSeconds = $logs->sum('duration_seconds');
        $totalSessions = $logs->count();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil riwayat latihan & statistik workout.',
            'summary' => [
                'total_sessions' => $totalSessions,
                'total_volume_kg' => (float) $totalVolume,
                'total_duration_minutes' => round($totalDurationSeconds / 60, 1),
                'xp_earned' => $totalSessions * 50,
            ],
            'data' => $logs,
        ]);
    }

    /**
     * Store new workout log from mobile tracker
     * POST /api/v1/workout-logs
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'workout_name' => 'nullable|string',
            'duration_seconds' => 'required|numeric|min:0',
            'total_volume_kg' => 'required|numeric|min:0',
            'completed_sets_count' => 'required|numeric|min:0',
            'total_sets_count' => 'required|numeric|min:0',
            'exercise_details' => 'nullable',
            'workout_date' => 'nullable|string',
        ]);

        $userId = $user ? $user->id : 1;
        $memberName = $user ? $user->name : ($request->input('member_name') ?: 'Budi Pratama Member');
        $workoutName = $validated['workout_name'] ?? 'Hypertrophy Day Workout';

        try {
            $formattedDate = !empty($validated['workout_date'])
                ? Carbon::parse($validated['workout_date'])->format('Y-m-d')
                : now()->format('Y-m-d');
        } catch (\Exception $e) {
            $formattedDate = now()->format('Y-m-d');
        }

        $details = $validated['exercise_details'] ?? [];
        if (is_string($details)) {
            $details = json_decode($details, true) ?? [];
        }

        $workoutLog = WorkoutLog::create([
            'user_id' => $userId,
            'member_name' => $memberName,
            'workout_name' => $workoutName,
            'duration_seconds' => (int) $validated['duration_seconds'],
            'total_volume_kg' => (float) $validated['total_volume_kg'],
            'completed_sets_count' => (int) $validated['completed_sets_count'],
            'total_sets_count' => (int) $validated['total_sets_count'],
            'exercise_details' => $details,
            'workout_date' => $formattedDate,
        ]);

        // Award +50 XP Reward Points to User for completing workout
        if ($user) {
            $user->reward_points = ($user->reward_points ?? 0) + 50;
            $user->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Workout Log BERHASIL disimpan ke Server! +50 XP Points didapatkan. 🔥',
            'data' => $workoutLog,
        ], 201);
    }
}
