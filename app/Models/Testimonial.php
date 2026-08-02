<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'program',
        'rating',
        'review',
        'avatar',
        'video_url',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];
}
