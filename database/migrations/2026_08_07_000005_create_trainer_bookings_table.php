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
        if (!Schema::hasTable('trainer_bookings')) {
            Schema::create('trainer_bookings', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->string('member_name');
                $table->string('coach_name');
                $table->date('booking_date');
                $table->string('booking_time'); // e.g. 17:00 - 18:00 WIB
                $table->string('branch')->default('Sleman HQ (Jl. Kaliurang)');
                $table->string('status')->default('CONFIRMED'); // CONFIRMED, COMPLETED, CANCELLED
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }

        // Add reward_points to users table if not exists
        if (!Schema::hasColumn('users', 'reward_points')) {
            Schema::table('users', function (Blueprint $table) {
                $table->integer('reward_points')->default(50)->after('remaining_sessions');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainer_bookings');
    }
};
