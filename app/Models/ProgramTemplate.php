<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'goal',
        'level',
        'duration_weeks',
        'estimated_duration_minutes',
        'status',
        'created_by',
    ];

    public function workouts()
    {
        return $this->hasMany(ProgramTemplateWorkout::class)->orderBy('week_number')->orderBy('day_number');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
