<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberProgramWorkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_program_id',
        'source_workout_id',
        'week_number',
        'day_number',
        'name',
        'scheduled_date',
        'status',
        'notes',
    ];

    public function memberProgram()
    {
        return $this->belongsTo(MemberProgram::class, 'member_program_id');
    }

    public function sourceWorkout()
    {
        return $this->belongsTo(ProgramTemplateWorkout::class, 'source_workout_id');
    }

    public function sessions()
    {
        return $this->hasMany(WorkoutSession::class, 'member_program_workout_id')->orderBy('created_at', 'desc');
    }
}
