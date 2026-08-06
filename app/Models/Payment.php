<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'member_name',
        'member_phone',
        'member_email',
        'package_name',
        'gross_amount',
        'discount_amount',
        'net_amount',
        'payment_type',
        'payment_method_detail',
        'transaction_status',
        'snap_token',
        'proof_img',
        'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'gross_amount' => 'float',
            'discount_amount' => 'float',
            'net_amount' => 'float',
            'paid_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isSettled(): bool
    {
        return in_array($this->transaction_status, ['settlement', 'capture', 'LUNAS (APPROVED)', 'approved']);
    }
}
