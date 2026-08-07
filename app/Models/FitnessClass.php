<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FitnessClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'coach_name',
        'class_date',
        'start_time',
        'end_time',
        'max_capacity',
        'booked_count',
        'branch',
        'price',
        'is_active',
    ];

    protected $casts = [
        'class_date' => 'date',
        'price' => 'decimal:2',
        'max_capacity' => 'integer',
        'booked_count' => 'integer',
        'is_active' => 'boolean',
    ];

    public function getAvailableSlotsAttribute(): int
    {
        return max(0, $this->max_capacity - $this->booked_count);
    }
}
