<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'muscle_group',
        'equipment',
        'difficulty',
        'instructions',
        'video_url',
        'image_url',
        'status',
    ];
}
