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
        if (!Schema::hasTable('member_program_workouts')) {
            Schema::create('member_program_workouts', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('member_program_id');
                $table->unsignedBigInteger('source_workout_id')->nullable();
                $table->integer('week_number')->default(1);
                $table->integer('day_number')->default(1);
                $table->string('name');
                $table->date('scheduled_date')->nullable();
                $table->string('status')->default('PLANNED'); // PLANNED, SCHEDULED, COMPLETED, SKIPPED, CANCELLED
                $table->text('notes')->nullable();
                $table->timestamps();

                $table->foreign('member_program_id')->references('id')->on('member_programs')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_program_workouts');
    }
};
