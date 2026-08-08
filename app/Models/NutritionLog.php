<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'member_name',
        'meal_name',
        'meal_type',
        'calories',
        'protein',
        'carbs',
        'fat',
        'is_ai_scanned',
        'ai_confidence',
        'log_date',
    ];

    protected $casts = [
        'calories' => 'integer',
        'protein' => 'integer',
        'carbs' => 'integer',
        'fat' => 'integer',
        'is_ai_scanned' => 'boolean',
        'log_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
