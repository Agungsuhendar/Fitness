<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramTemplateWorkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_template_id',
        'week_number',
        'day_number',
        'name',
        'description',
        'estimated_duration_minutes',
        'rest_day',
        'notes',
    ];

    protected $casts = [
        'rest_day' => 'boolean',
    ];

    public function template()
    {
        return $this->belongsTo(ProgramTemplate::class, 'program_template_id');
    }

    public function workoutExercises()
    {
        return $this->hasMany(WorkoutExercise::class, 'workout_id')->orderBy('sequence');
    }
}
