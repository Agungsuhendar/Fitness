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
        if (!Schema::hasTable('workout_sessions')) {
            Schema::create('workout_sessions', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('member_program_workout_id')->nullable();
                $table->unsignedBigInteger('member_id');
                $table->unsignedBigInteger('trainer_id')->nullable();
                $table->dateTime('started_at')->nullable();
                $table->dateTime('completed_at')->nullable();
                $table->string('status')->default('COMPLETED'); // IN_PROGRESS, COMPLETED, CANCELLED, NO_SHOW
                $table->integer('duration_minutes')->default(45);
                $table->text('trainer_notes')->nullable();
                $table->text('member_notes')->nullable();
                $table->timestamps();

                $table->foreign('member_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('member_program_workout_id')->references('id')->on('member_program_workouts')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_sessions');
    }
};
