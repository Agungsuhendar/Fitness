<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'category',
        'duration_days',
        'session_count',
        'price',
        'promo_price',
        'badge',
        'features',
        'description',
        'is_active',
        'order',
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
        'duration_days' => 'integer',
        'session_count' => 'integer',
        'price' => 'integer',
        'promo_price' => 'integer',
        'order' => 'integer',
    ];

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getFormattedPromoPriceAttribute(): ?string
    {
        return $this->promo_price ? 'Rp ' . number_format($this->promo_price, 0, ',', '.') : null;
    }
}
