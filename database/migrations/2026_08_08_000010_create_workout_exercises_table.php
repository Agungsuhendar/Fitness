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
        if (!Schema::hasTable('workout_exercises')) {
            Schema::create('workout_exercises', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('workout_id');
                $table->unsignedBigInteger('exercise_id');
                $table->integer('sequence')->default(1);
                $table->integer('sets')->default(3);
                $table->integer('reps')->nullable()->default(10);
                $table->decimal('target_weight', 8, 2)->nullable();
                $table->integer('duration_seconds')->nullable();
                $table->integer('rest_seconds')->default(60);
                $table->string('notes')->nullable();
                $table->timestamps();

                $table->foreign('workout_id')->references('id')->on('program_template_workouts')->onDelete('cascade');
                $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_exercises');
    }
};
