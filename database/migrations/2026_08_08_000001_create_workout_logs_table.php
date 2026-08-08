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
        if (!Schema::hasTable('workout_logs')) {
            Schema::create('workout_logs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
                $table->string('member_name')->default('Member VIP FitLife');
                $table->string('workout_name')->default('Hypertrophy Day');
                $table->integer('duration_seconds')->default(0);
                $table->decimal('total_volume_kg', 12, 2)->default(0);
                $table->integer('completed_sets_count')->default(0);
                $table->integer('total_sets_count')->default(0);
                $table->json('exercise_details')->nullable();
                $table->date('workout_date')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_logs');
    }
};
