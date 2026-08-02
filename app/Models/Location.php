<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'city',
        'address',
        'map_embed_url',
        'features',
        'image',
        'is_featured',
    ];

    protected $casts = [
        'features' => 'array',
        'is_featured' => 'boolean',
    ];
}
