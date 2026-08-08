<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgramTemplate;
use App\Models\ProgramTemplateWorkout;
use App\Models\Exercise;
use App\Models\MemberProgram;
use App\Models\User;
use Illuminate\Support\Str;

class AdminTrainingProgramController extends Controller
{
    public function index(Request $request)
    {
        try {
            if (Exercise::count() == 0) {
                Exercise::create(['name' => 'Barbell Bench Press', 'category' => 'Strength', 'muscle_group' => 'Chest', 'equipment' => 'Barbell', 'difficulty' => 'INTERMEDIATE', 'instructions' => 'Tekan barbell tegak lurus dari dada atas.']);
                Exercise::create(['name' => 'Barbell Back Squat', 'category' => 'Strength', 'muscle_group' => 'Legs', 'equipment' => 'Barbell', 'difficulty' => 'INTERMEDIATE', 'instructions' => 'Jaga punggung tetap lurus, turun hingga paha sejajar lantai.']);
                Exercise::create(['name' => 'Lat Pulldown', 'category' => 'Strength', 'muscle_group' => 'Back', 'equipment' => 'Cable Machine', 'difficulty' => 'BEGINNER', 'instructions' => 'Tarik stang ke arah dada atas dengan melatih otot latissimus.']);
                Exercise::create(['name' => 'Dumbbell Shoulder Press', 'category' => 'Strength', 'muscle_group' => 'Shoulders', 'equipment' => 'Dumbbell', 'difficulty' => 'BEGINNER', 'instructions' => 'Dorong dumbbell ke atas sejajar bahu.']);
                Exercise::create(['name' => 'Plank Hold', 'category' => 'Core', 'muscle_group' => 'Core', 'equipment' => 'Bodyweight', 'difficulty' => 'BEGINNER', 'instructions' => 'Kunci otot perut dan jaga posisi tubuh lurus horizontal.']);
            }

            if (ProgramTemplate::count() == 0) {
                $t1 = ProgramTemplate::create([
                    'name' => 'Fat Loss Beginner 12-Weeks',
                    'slug' => 'fat-loss-beginner',
                    'description' => 'Program terstruktur pembakaran lemak terakselerasi & pengencangan otot 12 minggu untuk pemula.',
                    'goal' => 'FAT_LOSS',
                    'level' => 'BEGINNER',
                    'duration_weeks' => 12,
                    'estimated_duration_minutes' => 45,
                    'status' => 'ACTIVE'
                ]);
                
                ProgramTemplateWorkout::create([
                    'program_template_id' => $t1->id,
                    'week_number' => 1,
                    'day_number' => 1,
                    'name' => 'Full Body A - Strength & Cardio Kickoff',
                    'estimated_duration_minutes' => 45,
                    'rest_day' => false,
                    'notes' => 'Sesi pembuka minggu pertama.'
                ]);

                $t2 = ProgramTemplate::create([
                    'name' => 'Hypertrophy Muscle Building 8-Weeks',
                    'slug' => 'muscle-building-intermediate',
                    'description' => 'Program hipertrofi intensif pembentukan massa otot dan kekuatan angkatan.',
                    'goal' => 'MUSCLE_GAIN',
                    'level' => 'INTERMEDIATE',
                    'duration_weeks' => 8,
                    'estimated_duration_minutes' => 60,
                    'status' => 'ACTIVE'
                ]);

                $t3 = ProgramTemplate::create([
                    'name' => 'Persiapan Fisik TNI / POLRI & BUMN',
                    'slug' => 'tni-polri-prep',
                    'description' => 'Program penggenjot ketahanan fisik, push up, sit up, & lari endurance.',
                    'goal' => 'ENDURANCE',
                    'level' => 'ADVANCED',
                    'duration_weeks' => 6,
                    'estimated_duration_minutes' => 60,
                    'status' => 'ACTIVE'
                ]);
            }

            if (MemberProgram::count() == 0 && ($m = User::where('role', 'member')->first())) {
                $tpl = ProgramTemplate::first();
                MemberProgram::create([
                    'member_id' => $m->id,
                    'program_template_id' => $tpl->id,
                    'start_date' => date('Y-m-d'),
                    'end_date' => date('Y-m-d', strtotime('+12 weeks')),
                    'goal' => $tpl->goal,
                    'status' => 'ACTIVE',
                    'notes' => 'Program pendampingan personal trainer 1-on-1.'
                ]);
            }
        } catch (\Throwable $e) {
            // Ignore auto-seed exceptions
        }

        try {
            $templates = ProgramTemplate::withCount(['workouts'])->orderBy('created_at', 'desc')->get();
        } catch (\Throwable $e) {
            $templates = collect();
        }

        try {
            $exercises = Exercise::where('status', 'ACTIVE')->get();
        } catch (\Throwable $e) {
            $exercises = collect();
        }

        try {
            $memberPrograms = MemberProgram::with(['member', 'template', 'trainer'])->orderBy('created_at', 'desc')->get();
        } catch (\Throwable $e) {
            $memberPrograms = collect();
        }

        try {
            $members = User::where('role', 'member')->orWhereNull('role')->orderBy('name')->get();
        } catch (\Throwable $e) {
            $members = collect();
        }

        try {
            $trainers = User::where('role', 'trainer')->orWhere('role', 'admin')->orderBy('name')->get();
        } catch (\Throwable $e) {
            $trainers = collect();
        }

        return view('admin.training_programs.index', compact('templates', 'exercises', 'memberPrograms', 'members', 'trainers'));
    }

    public function storeTemplate(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'goal' => 'required|string',
            'level' => 'required|string',
            'duration_weeks' => 'required|integer|min:1',
            'estimated_duration_minutes' => 'required|integer|min:10',
            'description' => 'nullable|string',
        ]);

        ProgramTemplate::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']) . '-' . rand(100, 999),
            'goal' => $validated['goal'],
            'level' => $validated['level'],
            'duration_weeks' => (int) $validated['duration_weeks'],
            'estimated_duration_minutes' => (int) $validated['estimated_duration_minutes'],
            'description' => $validated['description'] ?? null,
            'status' => 'ACTIVE',
        ]);

        return redirect()->back()->with('success', 'Program Template baru "' . $validated['name'] . '" berhasil dibuat!');
    }

    public function assignProgram(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:users,id',
            'program_template_id' => 'required|exists:program_templates,id',
            'trainer_id' => 'nullable|exists:users,id',
            'start_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $template = ProgramTemplate::findOrFail($validated['program_template_id']);
        $startDate = \Carbon\Carbon::parse($validated['start_date']);
        $endDate = $startDate->copy()->addWeeks($template->duration_weeks);

        MemberProgram::create([
            'member_id' => $validated['member_id'],
            'program_template_id' => $validated['program_template_id'],
            'trainer_id' => $validated['trainer_id'] ?? null,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'goal' => $template->goal,
            'status' => 'ACTIVE',
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Program latihan "' . $template->name . '" berhasil ditugaskan ke member!');
    }

    public function destroyTemplate($id)
    {
        $template = ProgramTemplate::findOrFail($id);
        $template->delete();

        return redirect()->back()->with('success', 'Program Template berhasil dihapus.');
    }
}
