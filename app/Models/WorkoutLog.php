<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'member_name',
        'workout_name',
        'duration_seconds',
        'total_volume_kg',
        'completed_sets_count',
        'total_sets_count',
        'exercise_details',
        'workout_date',
    ];

    protected $casts = [
        'duration_seconds' => 'integer',
        'total_volume_kg' => 'float',
        'completed_sets_count' => 'integer',
        'total_sets_count' => 'integer',
        'exercise_details' => 'array',
        'workout_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedDurationAttribute(): string
    {
        $minutes = floor($this->duration_seconds / 60);
        $seconds = $this->duration_seconds % 60;
        return sprintf('%02d:%02d', $minutes, $seconds);
    }
}
