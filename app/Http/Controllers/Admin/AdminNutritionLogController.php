<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NutritionLog;

class AdminNutritionLogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filterType = $request->input('type');

        $query = NutritionLog::with('user')->orderBy('created_at', 'desc');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('member_name', 'like', "%{$search}%")
                  ->orWhere('meal_name', 'like', "%{$search}%");
            });
        }

        if ($filterType === 'ai') {
            $query->where('is_ai_scanned', true);
        } elseif ($filterType === 'manual') {
            $query->where('is_ai_scanned', false);
        }

        $logs = $query->paginate(15);
        $totalCaloriesAll = NutritionLog::sum('calories');
        $totalProteinAll = NutritionLog::sum('protein');
        $totalAiScansAll = NutritionLog::where('is_ai_scanned', true)->count();

        return view('admin.nutrition_logs.index', compact('logs', 'totalCaloriesAll', 'totalProteinAll', 'totalAiScansAll', 'search', 'filterType'));
    }

    public function destroy($id)
    {
        $log = NutritionLog::findOrFail($id);
        $log->delete();

        return redirect()->back()->with('success', 'Catatan nutrisi berhasil dihapus.');
    }
}
