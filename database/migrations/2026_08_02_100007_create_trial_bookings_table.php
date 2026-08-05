<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trial_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('parent_name');
            $table->string('participant_name');
            $table->string('participant_age');
            $table->string('phone');
            $table->string('program_name');
            $table->string('preferred_location');
            $table->date('trial_date');
            $table->string('trial_time');
            $table->text('notes')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trial_bookings');
    }
};
