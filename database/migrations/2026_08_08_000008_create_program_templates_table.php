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
        if (!Schema::hasTable('program_templates')) {
            Schema::create('program_templates', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->text('description')->nullable();
                $table->string('goal')->default('FAT_LOSS'); // FAT_LOSS, MUSCLE_GAIN, STRENGTH, ENDURANCE, GENERAL_FITNESS, REHABILITATION
                $table->string('level')->default('BEGINNER'); // BEGINNER, INTERMEDIATE, ADVANCED
                $table->integer('duration_weeks')->default(12);
                $table->integer('estimated_duration_minutes')->default(45);
                $table->string('status')->default('ACTIVE'); // DRAFT, ACTIVE, ARCHIVED
                $table->unsignedBigInteger('created_by')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_templates');
    }
};
