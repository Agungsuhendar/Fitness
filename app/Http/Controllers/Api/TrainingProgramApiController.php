<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\ProgramTemplate;
use App\Models\MemberProgram;
use App\Models\MemberProgramWorkout;
use App\Models\WorkoutSession;
use App\Models\MemberProgress;
use App\Models\User;

class TrainingProgramApiController extends Controller
{
    /**
     * Master Exercises Catalog
     * GET /api/v1/training/exercises
     */
    public function exercises(Request $request)
    {
        $exercises = Exercise::where('status', 'ACTIVE')->get();

        if ($exercises->isEmpty()) {
            $defaultExercises = [
                ['name' => 'Barbell Bench Press', 'category' => 'Strength', 'muscle_group' => 'Chest', 'equipment' => 'Barbell', 'difficulty' => 'INTERMEDIATE', 'instructions' => 'Retract scapula, lower bar to mid chest, press up.'],
                ['name' => 'Barbell Back Squat', 'category' => 'Strength', 'muscle_group' => 'Legs', 'equipment' => 'Barbell', 'difficulty' => 'INTERMEDIATE', 'instructions' => 'Hip hinge first, keep knees aligned with toes, squat to parallel.'],
                ['name' => 'Lat Pulldown', 'category' => 'Strength', 'muscle_group' => 'Back', 'equipment' => 'Cable', 'difficulty' => 'BEGINNER', 'instructions' => 'Pull bar to upper chest using lats, chest up.'],
                ['name' => 'Dumbbell Shoulder Press', 'category' => 'Strength', 'muscle_group' => 'Shoulders', 'equipment' => 'Dumbbell', 'difficulty' => 'BEGINNER', 'instructions' => 'Press dumbbells vertically overhead without clacking.'],
                ['name' => 'Plank Hold', 'category' => 'Core', 'muscle_group' => 'Core', 'equipment' => 'Bodyweight', 'difficulty' => 'BEGINNER', 'instructions' => 'Engage core, maintain flat back position for duration.'],
            ];

            foreach ($defaultExercises as $item) {
                Exercise::create($item);
            }
            $exercises = Exercise::all();
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil katalog master exercise.',
            'total' => count($exercises),
            'data' => $exercises,
        ]);
    }

    /**
     * Program Templates Catalog
     * GET /api/v1/training/program-templates
     */
    public function templates(Request $request)
    {
        $templates = ProgramTemplate::with('workouts.workoutExercises.exercise')->where('status', 'ACTIVE')->get();

        if ($templates->isEmpty()) {
            $pt = ProgramTemplate::create([
                'name' => 'Fat Loss Beginner 12-Weeks',
                'slug' => 'fat-loss-beginner',
                'description' => 'Program terstruktur pembakaran lemak & pengencangan otot 12 minggu.',
                'goal' => 'FAT_LOSS',
                'level' => 'BEGINNER',
                'duration_weeks' => 12,
                'estimated_duration_minutes' => 45,
                'status' => 'ACTIVE',
            ]);

            $templates = ProgramTemplate::with('workouts.workoutExercises.exercise')->where('status', 'ACTIVE')->get();
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil daftar Program Template.',
            'total' => count($templates),
            'data' => $templates,
        ]);
    }

    /**
     * Get Logged-in Member's Active Training Program
     * GET /api/v1/training/my-program
     */
    public function myProgram(Request $request)
    {
        $user = $request->user();
        $memberId = $user ? $user->id : 1;

        $program = MemberProgram::with(['template', 'trainer', 'memberWorkouts', 'progressRecords'])
            ->where('member_id', $memberId)
            ->where('status', 'ACTIVE')
            ->first();

        if (!$program) {
            // Seed a demo member program if none assigned yet
            $template = ProgramTemplate::first();
            $program = MemberProgram::create([
                'member_id' => $memberId,
                'program_template_id' => $template ? $template->id : null,
                'trainer_id' => null,
                'start_date' => now()->format('Y-m-d'),
                'end_date' => now()->addWeeks(12)->format('Y-m-d'),
                'goal' => 'FAT_LOSS',
                'status' => 'ACTIVE',
                'notes' => 'Fokus pada penurunan kadar lemak dan peningkatan kekuatan otot dasar.',
            ]);

            // Create initial workouts
            MemberProgramWorkout::create([
                'member_program_id' => $program->id,
                'week_number' => 1,
                'day_number' => 1,
                'name' => 'Full Body A - Strength & Cardio Kickoff',
                'scheduled_date' => now()->format('Y-m-d'),
                'status' => 'SCHEDULED',
            ]);

            $program = MemberProgram::with(['template', 'trainer', 'memberWorkouts', 'progressRecords'])->find($program->id);
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil Member Training Program aktif.',
            'data' => $program,
        ]);
    }

    /**
     * Start Workout Session
     * POST /api/v1/training/workout-sessions/start
     */
    public function startSession(Request $request)
    {
        $user = $request->user();
        $memberId = $user ? $user->id : 1;

        $session = WorkoutSession::create([
            'member_program_workout_id' => $request->input('member_program_workout_id'),
            'member_id' => $memberId,
            'trainer_id' => $request->input('trainer_id'),
            'started_at' => now(),
            'status' => 'IN_PROGRESS',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Sesi latihan berhasil dimulai! 🔥',
            'session_id' => $session->id,
            'data' => $session,
        ]);
    }

    /**
     * Complete Workout Session
     * POST /api/v1/training/workout-sessions/complete
     */
    public function completeSession(Request $request)
    {
        $sessionId = $request->input('session_id');
        $session = WorkoutSession::find($sessionId);

        if ($session) {
            $session->update([
                'completed_at' => now(),
                'status' => 'COMPLETED',
                'duration_minutes' => (int) $request->input('duration_minutes', 45),
                'member_notes' => $request->input('notes'),
            ]);

            if ($session->member_program_workout_id) {
                MemberProgramWorkout::where('id', $session->member_program_workout_id)->update(['status' => 'COMPLETED']);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Selamat! Sesi latihan telah berhasil diselesaikan! 🏆',
            'data' => $session,
        ]);
    }

    /**
     * Get Member Physical Progress Tracking
     * GET /api/v1/training/progress
     */
    public function getProgress(Request $request)
    {
        $user = $request->user();
        $memberId = $user ? $user->id : 1;

        $progressList = MemberProgress::where('member_id', $memberId)->orderBy('recorded_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data progres fisik member.',
            'total' => count($progressList),
            'data' => $progressList,
        ]);
    }

    /**
     * Record Member Physical Progress
     * POST /api/v1/training/progress
     */
    public function storeProgress(Request $request)
    {
        $user = $request->user();
        $memberId = $user ? $user->id : 1;

        $validated = $request->validate([
            'weight' => 'required|numeric',
            'body_fat' => 'nullable|numeric',
            'chest' => 'nullable|numeric',
            'waist' => 'nullable|numeric',
            'arm' => 'nullable|numeric',
            'thigh' => 'nullable|numeric',
            'notes' => 'nullable|string',
        ]);

        $rec = MemberProgress::create([
            'member_id' => $memberId,
            'recorded_at' => now()->format('Y-m-d'),
            'weight' => $validated['weight'],
            'body_fat' => $validated['body_fat'] ?? null,
            'chest' => $validated['chest'] ?? null,
            'waist' => $validated['waist'] ?? null,
            'arm' => $validated['arm'] ?? null,
            'thigh' => $validated['thigh'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'recorded_by' => $memberId,
        ]);

        // Update user current weight
        User::where('id', $memberId)->update(['current_weight' => $validated['weight']]);

        return response()->json([
            'success' => true,
            'message' => 'Progres fisik berhasil dicatat! 📊',
            'data' => $rec,
        ]);
    }
}
