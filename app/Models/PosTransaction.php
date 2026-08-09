<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'member_name',
        'member_phone',
        'subtotal',
        'discount',
        'total',
        'pay_amount',
        'change_amount',
        'payment_method',
        'payment_status',
        'notes',
        'transacted_at',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
        'pay_amount' => 'decimal:2',
        'change_amount' => 'decimal:2',
        'transacted_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(PosTransactionItem::class, 'pos_transaction_id');
    }
}
