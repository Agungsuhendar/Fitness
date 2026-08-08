<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkoutLog;

class AdminWorkoutLogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = WorkoutLog::with('user')->orderBy('created_at', 'desc');

        if ($search) {
            $query->where('member_name', 'like', "%{$search}%")
                  ->orWhere('workout_name', 'like', "%{$search}%");
        }

        $logs = $query->paginate(15);
        $totalVolumeAll = WorkoutLog::sum('total_volume_kg');
        $totalSessionsAll = WorkoutLog::count();

        return view('admin.workout_logs.index', compact('logs', 'totalVolumeAll', 'totalSessionsAll', 'search'));
    }

    public function destroy($id)
    {
        $log = WorkoutLog::findOrFail($id);
        $log->delete();

        return redirect()->back()->with('success', 'Workout Log berhasil dihapus.');
    }
}
