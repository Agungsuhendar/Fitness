<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'subtitle',
        'target_audience',
        'description',
        'features',
        'benefits',
        'curriculum',
        'price_start',
        'icon',
        'image',
        'badge',
        'order',
    ];

    protected $casts = [
        'features' => 'array',
        'benefits' => 'array',
        'curriculum' => 'array',
    ];
}
