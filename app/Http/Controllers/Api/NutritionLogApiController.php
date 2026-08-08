<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NutritionLog;
use App\Models\User;
use Carbon\Carbon;

class NutritionLogApiController extends Controller
{
    /**
     * Get member's nutrition logs & today macro summary
     * GET /api/v1/nutrition-logs
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $userId = $user ? $user->id : 1;
        $today = now()->format('Y-m-d');

        $logs = NutritionLog::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        $todayLogs = $logs->filter(function ($log) use ($today) {
            return $log->created_at->format('Y-m-d') === $today || ($log->log_date && $log->log_date->format('Y-m-d') === $today);
        });

        $totalCalories = $todayLogs->sum('calories');
        $totalProtein = $todayLogs->sum('protein');
        $totalCarbs = $todayLogs->sum('carbs');
        $totalFat = $todayLogs->sum('fat');

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data catatan nutrisi & kalori.',
            'today_summary' => [
                'calories_consumed' => $totalCalories,
                'target_calories' => 2200,
                'protein_consumed' => $totalProtein,
                'target_protein' => 180,
                'carbs_consumed' => $totalCarbs,
                'target_carbs' => 220,
                'fat_consumed' => $totalFat,
                'target_fat' => 65,
            ],
            'data' => $logs,
        ]);
    }

    /**
     * Store new meal log or AI meal scan log
     * POST /api/v1/nutrition-logs
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'meal_name' => 'required|string',
            'meal_type' => 'nullable|string',
            'calories' => 'required|numeric|min:0',
            'protein' => 'required|numeric|min:0',
            'carbs' => 'required|numeric|min:0',
            'fat' => 'required|numeric|min:0',
            'is_ai_scanned' => 'nullable|boolean',
            'ai_confidence' => 'nullable|string',
            'log_date' => 'nullable|string',
        ]);

        $userId = $user ? $user->id : 1;
        $memberName = $user ? $user->name : ($request->input('member_name') ?: 'Budi Pratama Member');

        try {
            $formattedDate = !empty($validated['log_date'])
                ? Carbon::parse($validated['log_date'])->format('Y-m-d')
                : now()->format('Y-m-d');
        } catch (\Exception $e) {
            $formattedDate = now()->format('Y-m-d');
        }

        $nutritionLog = NutritionLog::create([
            'user_id' => $userId,
            'member_name' => $memberName,
            'meal_name' => $validated['meal_name'],
            'meal_type' => $validated['meal_type'] ?? 'Makan Malam',
            'calories' => (int) $validated['calories'],
            'protein' => (int) $validated['protein'],
            'carbs' => (int) $validated['carbs'],
            'fat' => (int) $validated['fat'],
            'is_ai_scanned' => filter_var($request->input('is_ai_scanned', false), FILTER_VALIDATE_BOOLEAN),
            'ai_confidence' => $validated['ai_confidence'] ?? null,
            'log_date' => $formattedDate,
        ]);

        // Award +25 XP Reward Points to User for tracking meal
        if ($user) {
            $user->reward_points = ($user->reward_points ?? 0) + 25;
            $user->save();
        }

        $aiBadge = $nutritionLog->is_ai_scanned ? ' (AI Vision Scan 📸)' : '';

        return response()->json([
            'success' => true,
            'message' => 'Catatan Nutrisi "' . $nutritionLog->meal_name . '"' . $aiBadge . ' BERHASIL disimpan ke Server! +25 XP Points. 🥗',
            'data' => $nutritionLog,
        ], 201);
    }
}
