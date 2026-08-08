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
        if (!Schema::hasTable('program_template_workouts')) {
            Schema::create('program_template_workouts', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('program_template_id');
                $table->integer('week_number')->default(1);
                $table->integer('day_number')->default(1);
                $table->string('name'); // e.g. Workout A, Full Body A, Chest & Triceps
                $table->text('description')->nullable();
                $table->integer('estimated_duration_minutes')->default(45);
                $table->boolean('rest_day')->default(false);
                $table->text('notes')->nullable();
                $table->timestamps();

                $table->foreign('program_template_id')->references('id')->on('program_templates')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_template_workouts');
    }
};
