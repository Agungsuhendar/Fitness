<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosShift extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cashier_name',
        'opened_at',
        'closed_at',
        'initial_cash',
        'expected_cash',
        'actual_cash',
        'difference',
        'total_cash_sales',
        'total_non_cash_sales',
        'total_cash_in',
        'total_cash_out',
        'status',
        'notes',
    ];

    protected $casts = [
        'opened_at' => 'datetime',
        'closed_at' => 'datetime',
        'initial_cash' => 'decimal:2',
        'expected_cash' => 'decimal:2',
        'actual_cash' => 'decimal:2',
        'difference' => 'decimal:2',
        'total_cash_sales' => 'decimal:2',
        'total_non_cash_sales' => 'decimal:2',
        'total_cash_in' => 'decimal:2',
        'total_cash_out' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movements()
    {
        return $this->hasMany(PosCashMovement::class);
    }
}
