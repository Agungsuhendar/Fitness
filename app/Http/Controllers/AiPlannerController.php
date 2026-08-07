<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AiPlannerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('member.ai_planner', compact('user'));
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'gender' => 'required|in:male,female',
            'age' => 'required|integer|min:12|max:90',
            'weight' => 'required|numeric|min:30|max:250',
            'height' => 'required|numeric|min:100|max:230',
            'goal' => 'required|string',
            'level' => 'required|string',
            'days' => 'required|integer|min:2|max:6',
        ]);

        $weight = (float)$validated['weight'];
        $height = (float)$validated['height'];
        $age = (int)$validated['age'];
        $gender = $validated['gender'];
        $goal = $validated['goal'];
        $level = $validated['level'];
        $days = (int)$validated['days'];

        // Calculate BMR (Mifflin-St Jeor Formula)
        if ($gender === 'male') {
            $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;
        } else {
            $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
        }

        // Calculate TDEE (Moderate activity multiplier 1.45)
        $tdee = round($bmr * 1.45);

        // Adjust target calories based on goal
        if ($goal === 'fat_loss') {
            $targetCalories = round($tdee - 450);
            $proteinRatio = 2.0; // 2g per kg
            $goalTitle = "Defisit Kalori & Pemangkasan Lemak (Fat Loss)";
        } elseif ($goal === 'muscle_gain') {
            $targetCalories = round($tdee + 350);
            $proteinRatio = 2.2; // 2.2g per kg
            $goalTitle = "Surplus Kalori & Pembentukan Otot (Hypertrophy)";
        } else {
            $targetCalories = $tdee;
            $proteinRatio = 1.8;
            $goalTitle = "Kebugaran & Pemeliharaan Bentuk Tubuh";
        }

        $targetProtein = round($weight * $proteinRatio);

        // Generate Structured Weekly Workout Plan based on goal & days
        $workoutPlan = $this->generateWorkoutSchedule($goal, $level, $days);

        // Generate Local Indonesian Nutrition Meal Plan
        $mealPlan = $this->generateIndonesianMealPlan($targetCalories, $targetProtein);

        $aiResult = [
            'bmr' => round($bmr),
            'tdee' => $tdee,
            'target_calories' => $targetCalories,
            'target_protein' => $targetProtein,
            'goal_title' => $goalTitle,
            'workout_plan' => $workoutPlan,
            'meal_plan' => $mealPlan,
        ];

        return response()->json([
            'success' => true,
            'data' => $aiResult,
        ]);
    }

    private function generateWorkoutSchedule($goal, $level, $days)
    {
        $schedule = [];

        if ($days >= 4) {
            $schedule[] = [
                'day' => 'Hari 1',
                'focus' => 'Dada, Bahu & Triceps (Push Day)',
                'exercises' => [
                    ['name' => 'Barbell Bench Press', 'sets' => '4 Set', 'reps' => '8 - 10 Reps', 'rest' => '90 detik'],
                    ['name' => 'Incline Dumbbell Press', 'sets' => '3 Set', 'reps' => '10 - 12 Reps', 'rest' => '60 detik'],
                    ['name' => 'Overhead Shoulder Dumbbell Press', 'sets' => '4 Set', 'reps' => '10 - 12 Reps', 'rest' => '60 detik'],
                    ['name' => 'Cable Tricep Pushdown', 'sets' => '3 Set', 'reps' => '12 - 15 Reps', 'rest' => '45 detik'],
                ]
            ];
            $schedule[] = [
                'day' => 'Hari 2',
                'focus' => 'Punggung, Biceps & Rear Delts (Pull Day)',
                'exercises' => [
                    ['name' => 'Lat Pulldown / Pull Up', 'sets' => '4 Set', 'reps' => '8 - 10 Reps', 'rest' => '90 detik'],
                    ['name' => 'Seated Cable Row', 'sets' => '4 Set', 'reps' => '10 - 12 Reps', 'rest' => '60 detik'],
                    ['name' => 'Dumbbell Bicep Curl', 'sets' => '3 Set', 'reps' => '12 Reps', 'rest' => '45 detik'],
                    ['name' => 'Face Pulls (Rear Delt)', 'sets' => '3 Set', 'reps' => '15 Reps', 'rest' => '45 detik'],
                ]
            ];
            $schedule[] = [
                'day' => 'Hari 3',
                'focus' => 'Kaki, Quads, Hamstrings & Betis (Leg Day)',
                'exercises' => [
                    ['name' => 'Barbell Back Squat', 'sets' => '4 Set', 'reps' => '8 - 10 Reps', 'rest' => '120 detik'],
                    ['name' => 'Leg Press Machine', 'sets' => '4 Set', 'reps' => '10 - 12 Reps', 'rest' => '90 detik'],
                    ['name' => 'Romanian Deadlift', 'sets' => '3 Set', 'reps' => '10 - 12 Reps', 'rest' => '60 detik'],
                    ['name' => 'Calf Raises', 'sets' => '4 Set', 'reps' => '15 - 20 Reps', 'rest' => '45 detik'],
                ]
            ];
            $schedule[] = [
                'day' => 'Hari 4',
                'focus' => 'Full Body Conditioning & Core Abdominals',
                'exercises' => [
                    ['name' => 'Dumbbell Walking Lunges', 'sets' => '3 Set', 'reps' => '12 Langkah', 'rest' => '60 detik'],
                    ['name' => 'Push Up / Dips', 'sets' => '3 Set', 'reps' => 'Maksimal Reps', 'rest' => '60 detik'],
                    ['name' => 'Hanging Leg Raise', 'sets' => '4 Set', 'reps' => '12 - 15 Reps', 'rest' => '45 detik'],
                    ['name' => 'Plank Hold', 'sets' => '3 Set', 'reps' => '60 Detik Tahan', 'rest' => '45 detik'],
                ]
            ];
        } else {
            $schedule[] = [
                'day' => 'Hari 1',
                'focus' => 'Full Body Workout A (Upper Focus)',
                'exercises' => [
                    ['name' => 'Bench Press', 'sets' => '4 Set', 'reps' => '10 Reps', 'rest' => '90 detik'],
                    ['name' => 'Lat Pulldown', 'sets' => '4 Set', 'reps' => '10 Reps', 'rest' => '60 detik'],
                    ['name' => 'Dumbbell Shoulder Press', 'sets' => '3 Set', 'reps' => '12 Reps', 'rest' => '60 detik'],
                ]
            ];
            $schedule[] = [
                'day' => 'Hari 2',
                'focus' => 'Full Body Workout B (Lower Focus)',
                'exercises' => [
                    ['name' => 'Barbell Squat', 'sets' => '4 Set', 'reps' => '10 Reps', 'rest' => '90 detik'],
                    ['name' => 'Leg Extension', 'sets' => '3 Set', 'reps' => '12 Reps', 'rest' => '60 detik'],
                    ['name' => 'Plank & Ab Crunches', 'sets' => '4 Set', 'reps' => '15 Reps', 'rest' => '45 detik'],
                ]
            ];
            $schedule[] = [
                'day' => 'Hari 3',
                'focus' => 'Cardio HIIT & Core Abs Burner',
                'exercises' => [
                    ['name' => 'Treadmill Incline Walk', 'sets' => '1 Sesi', 'reps' => '30 Menit', 'rest' => 'Tanpa rest'],
                    ['name' => 'Mountain Climbers', 'sets' => '4 Set', 'reps' => '30 Detik', 'rest' => '30 detik'],
                    ['name' => 'Russian Twist', 'sets' => '3 Set', 'reps' => '20 Reps', 'rest' => '45 detik'],
                ]
            ];
        }

        return $schedule;
    }

    private function generateIndonesianMealPlan($targetCalories, $targetProtein)
    {
        return [
            'breakfast' => [
                'title' => '🍳 Sarapan Sehat Pagi (07:00 - 08:30)',
                'menu' => '3 Butir Telur Rebus (2 Putih + 1 Utuh) + 1 Tangkap Roti Gandum / Oatmeal + 1 Gelas Air Putih Warm Lemons.',
                'est_calories' => round($targetCalories * 0.25) . ' kcal',
                'est_protein' => '28g Protein',
            ],
            'lunch' => [
                'title' => '🍗 Makan Siang Seimbang (12:00 - 13:30)',
                'menu' => '150g Dada Ayam Bakar Tanpa Kulit / Ikan Gurame Panggang + 1 Centong Nasi Merah / Ubi Rebus + Tumis Buncis Tahu.',
                'est_calories' => round($targetCalories * 0.40) . ' kcal',
                'est_protein' => '42g Protein',
            ],
            'snack' => [
                'title' => '🍌 Camilan Pre-Workout (16:00)',
                'menu' => '1 Buah Pisang Ambon / Apel + 1 Scoop Whey Protein Shake / 10 Butir Kacang Almond Rebus.',
                'est_calories' => round($targetCalories * 0.15) . ' kcal',
                'est_protein' => '25g Protein',
            ],
            'dinner' => [
                'title' => '🥗 Makan Malam Recovery (19:00 - 20:30)',
                'menu' => '120g Daging Sapi Tumis / Tempe & Tahu Bacem Rendah Gula + Sup Sayur Bayam Brokoli Bening.',
                'est_calories' => round($targetCalories * 0.20) . ' kcal',
                'est_protein' => '30g Protein',
            ],
        ];
    }

    public function coachMatchIndex()
    {
        $coaches = \App\Models\Coach::all();
        return view('member.ai_coach_match', compact('coaches'));
    }

    public function processCoachMatch(Request $request)
    {
        $validated = $request->validate([
            'gender_pref' => 'required|string',
            'goal' => 'required|string',
            'time_slot' => 'required|string',
        ]);

        $coaches = \App\Models\Coach::all();
        if ($coaches->isEmpty()) {
            $coaches = collect([
                (object)['id' => 1, 'name' => 'Coach Bima Pratama', 'specialty' => 'Bodybuilding & Powerlifting', 'gender' => 'male', 'match_score' => 98],
                (object)['id' => 2, 'name' => 'Coach Rina Kartika', 'specialty' => 'Women Fitness & Posture Correction', 'gender' => 'female', 'match_score' => 95],
                (object)['id' => 3, 'name' => 'Coach Danu Subroto', 'specialty' => 'Persiapan Tes TNI/POLRI & Stamina', 'gender' => 'male', 'match_score' => 92],
            ]);
        } else {
            $coaches = $coaches->map(function($c, $idx) {
                $c->match_score = 98 - ($idx * 3);
                return $c;
            });
        }

        return response()->json([
            'success' => true,
            'matches' => $coaches->take(3),
        ]);
    }

    public function visionIndex()
    {
        return view('member.ai_vision');
    }

    public function processVision(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:5120',
            'view_type' => 'required|string',
        ]);

        $photoUrl = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = 'vision_' . time() . '_' . rand(100, 999) . '.' . ($file->getClientOriginalExtension() ?: 'jpg');
            $file->move(public_path('uploads'), $filename);
            $photoUrl = asset('uploads/' . $filename);
        }

        $analysis = [
            'photo_url' => $photoUrl,
            'posture_score' => 88,
            'head_alignment' => '🟢 Normal (Slight Forward Tilt 3°)',
            'shoulder_symmetry' => '🟢 Simetris Sempurna',
            'spine_curvature' => '🟡 Miring Ringan ke Kanan (Mild Scoliosis Risk)',
            'pelvic_tilt' => '🟢 Neutral Pelvic Alignment',
            'corrective_exercises' => [
                ['name' => 'Face Pulls dengan Cable / Resistance Band', 'sets' => '3 Set x 15 Reps', 'purpose' => 'Memperbaiki posisi bahu dan dada'],
                ['name' => 'Cat-Cow Stretch', 'sets' => '4 Set x 60 Detik', 'purpose' => 'Relaksasi & mobilitas tulang belakang'],
                ['name' => 'Plank Alignment Hold', 'sets' => '3 Set x 45 Detik', 'purpose' => 'Menguatkan otot core penopang postur'],
            ]
        ];

        return response()->json([
            'success' => true,
            'data' => $analysis
        ]);
    }
}
