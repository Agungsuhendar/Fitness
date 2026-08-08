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
        if (!Schema::hasTable('member_programs')) {
            Schema::create('member_programs', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('member_id');
                $table->unsignedBigInteger('program_template_id')->nullable();
                $table->unsignedBigInteger('trainer_id')->nullable();
                $table->date('start_date');
                $table->date('end_date')->nullable();
                $table->string('goal')->default('FAT_LOSS');
                $table->string('status')->default('ACTIVE'); // PLANNED, ACTIVE, PAUSED, COMPLETED, CANCELLED
                $table->text('notes')->nullable();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->timestamps();

                $table->foreign('member_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('program_template_id')->references('id')->on('program_templates')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_programs');
    }
};
