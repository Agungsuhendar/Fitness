<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'program_template_id',
        'trainer_id',
        'start_date',
        'end_date',
        'goal',
        'status',
        'notes',
        'created_by',
    ];

    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function template()
    {
        return $this->belongsTo(ProgramTemplate::class, 'program_template_id');
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function memberWorkouts()
    {
        return $this->hasMany(MemberProgramWorkout::class)->orderBy('week_number')->orderBy('day_number');
    }

    public function progressRecords()
    {
        return $this->hasMany(MemberProgress::class)->orderBy('recorded_at', 'desc');
    }
}
