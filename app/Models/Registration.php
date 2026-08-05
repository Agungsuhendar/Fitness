<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'age_category',
        'program_name',
        'preferred_location',
        'preferred_schedule',
        'notes',
        'status',
    ];
}
