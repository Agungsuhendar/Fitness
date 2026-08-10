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
        if (!Schema::hasTable('class_bookings')) {
            Schema::create('class_bookings', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('fitness_class_id')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('member_name');
                $table->string('member_phone')->nullable();
                $table->string('booking_type')->default('confirmed'); // confirmed, waitlist
                $table->integer('waitlist_position')->nullable(); // 1, 2, 3...
                $table->string('status')->default('active'); // active, promoted, cancelled, attended
                $table->timestamp('promoted_at')->nullable();
                $table->timestamp('cancelled_at')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_bookings');
    }
};
