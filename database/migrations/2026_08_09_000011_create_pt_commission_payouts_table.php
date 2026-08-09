<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('pt_commission_payouts')) {
            Schema::create('pt_commission_payouts', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('coach_id')->nullable();
                $table->string('coach_name');
                $table->string('period_month'); // e.g. 2026-08
                $table->integer('total_sessions_conducted')->default(0);
                $table->decimal('rate_per_session', 15, 2)->default(75000);
                $table->decimal('commission_percentage', 5, 2)->default(40.00);
                $table->decimal('total_payout_amount', 15, 2)->default(0);
                $table->string('status')->default('pending'); // pending, paid
                $table->timestamp('paid_at')->nullable();
                $table->text('notes')->nullable();
                $table->string('created_by')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pt_commission_payouts');
    }
};
