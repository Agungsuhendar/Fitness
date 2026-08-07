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
        if (!Schema::hasTable('fitness_classes')) {
            Schema::create('fitness_classes', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('category')->default('Aerobic');
                $table->string('coach_name');
                $table->date('class_date');
                $table->time('start_time');
                $table->time('end_time');
                $table->integer('max_capacity')->default(15);
                $table->integer('booked_count')->default(0);
                $table->string('branch')->default('Sleman HQ (Jl. Kaliurang)');
                $table->decimal('price', 12, 2)->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fitness_classes');
    }
};
