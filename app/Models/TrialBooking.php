<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrialBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_name',
        'participant_name',
        'participant_age',
        'phone',
        'program_name',
        'preferred_location',
        'trial_date',
        'trial_time',
        'notes',
        'status',
    ];

    protected $casts = [
        'trial_date' => 'date',
    ];
}
