<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_program_workout_id',
        'member_id',
        'trainer_id',
        'started_at',
        'completed_at',
        'status',
        'duration_minutes',
        'trainer_notes',
        'member_notes',
    ];

    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function memberWorkout()
    {
        return $this->belongsTo(MemberProgramWorkout::class, 'member_program_workout_id');
    }
}
