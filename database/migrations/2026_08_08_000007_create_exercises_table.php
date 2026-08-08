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
        if (!Schema::hasTable('exercises')) {
            Schema::create('exercises', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('category')->default('Strength'); // Strength, Cardio, Flexibility, Calisthenics
                $table->string('muscle_group')->default('Chest'); // Chest, Back, Legs, Shoulders, Arms, Core, Full Body
                $table->string('equipment')->nullable(); // Barbell, Dumbbell, Machine, Bodyweight, Cable
                $table->string('difficulty')->default('INTERMEDIATE'); // BEGINNER, INTERMEDIATE, ADVANCED
                $table->text('instructions')->nullable();
                $table->string('video_url')->nullable();
                $table->string('image_url')->nullable();
                $table->string('status')->default('ACTIVE'); // ACTIVE, INACTIVE
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
