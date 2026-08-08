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
        if (!Schema::hasTable('member_progress')) {
            Schema::create('member_progress', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('member_id');
                $table->unsignedBigInteger('member_program_id')->nullable();
                $table->date('recorded_at');
                $table->decimal('weight', 5, 2)->nullable();
                $table->decimal('body_fat', 5, 2)->nullable();
                $table->decimal('bmi', 5, 2)->nullable();
                $table->decimal('chest', 5, 2)->nullable();
                $table->decimal('waist', 5, 2)->nullable();
                $table->decimal('arm', 5, 2)->nullable();
                $table->decimal('thigh', 5, 2)->nullable();
                $table->text('notes')->nullable();
                $table->unsignedBigInteger('recorded_by')->nullable();
                $table->timestamps();

                $table->foreign('member_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('member_program_id')->references('id')->on('member_programs')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_progress');
    }
};
