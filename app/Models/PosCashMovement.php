<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosCashMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'pos_shift_id',
        'user_id',
        'type',
        'amount',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function shift()
    {
        return $this->belongsTo(PosShift::class, 'pos_shift_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
