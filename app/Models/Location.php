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
        'current_capacity',
        'max_capacity',
        'crowd_status',
        'distance_text',
        'hours',
        'phone',
    ];

    protected $casts = [
        'features' => 'array',
        'is_featured' => 'boolean',
        'current_capacity' => 'integer',
        'max_capacity' => 'integer',
    ];

    public function getOccupancyPercentAttribute(): float
    {
        if ($this->max_capacity <= 0) return 0.0;
        return round($this->current_capacity / $this->max_capacity, 2);
    }
}
