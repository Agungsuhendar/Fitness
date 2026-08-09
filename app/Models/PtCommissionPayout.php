<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class PtCommissionPayout extends Model
{
    use HasFactory;

    protected $fillable = [
        'coach_id',
        'coach_name',
        'period_month',
        'total_sessions_conducted',
        'rate_per_session',
        'commission_percentage',
        'total_payout_amount',
        'status',
        'paid_at',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'total_sessions_conducted' => 'integer',
        'rate_per_session' => 'decimal:2',
        'commission_percentage' => 'decimal:2',
        'total_payout_amount' => 'decimal:2',
    ];

    public static function ensureTable()
    {
        if (!Schema::hasTable('pt_commission_payouts')) {
            Schema::create('pt_commission_payouts', function ($table) {
                $table->id();
                $table->unsignedBigInteger('coach_id')->nullable();
                $table->string('coach_name');
                $table->string('period_month');
                $table->integer('total_sessions_conducted')->default(0);
                $table->decimal('rate_per_session', 15, 2)->default(75000);
                $table->decimal('commission_percentage', 5, 2)->default(40.00);
                $table->decimal('total_payout_amount', 15, 2)->default(0);
                $table->string('status')->default('pending');
                $table->timestamp('paid_at')->nullable();
                $table->text('notes')->nullable();
                $table->string('created_by')->nullable();
                $table->timestamps();
            });
        }
    }

    public function coach()
    {
        return $this->belongsTo(Coach::class, 'coach_id');
    }

    public function markAsPaid()
    {
        $this->status = 'paid';
        $this->paid_at = now();
        $this->save();
        return $this;
    }
}
