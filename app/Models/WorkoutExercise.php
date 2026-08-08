<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutExercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'workout_id',
        'exercise_id',
        'sequence',
        'sets',
        'reps',
        'target_weight',
        'duration_seconds',
        'rest_seconds',
        'notes',
    ];

    public function workout()
    {
        return $this->belongsTo(ProgramTemplateWorkout::class, 'workout_id');
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'exercise_id');
    }
}
