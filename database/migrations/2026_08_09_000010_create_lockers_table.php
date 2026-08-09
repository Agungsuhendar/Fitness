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
        if (!Schema::hasTable('lockers')) {
            Schema::create('lockers', function (Blueprint $table) {
                $table->id();
                $table->string('locker_number')->unique();
                $table->string('gender_category')->default('all'); // male, female, all
                $table->string('status')->default('available'); // available, occupied, maintenance
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('member_name')->nullable();
                $table->timestamp('assigned_at')->nullable();
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lockers');
    }
};
