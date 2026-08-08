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
        Schema::table('locations', function (Blueprint $table) {
            if (!Schema::hasColumn('locations', 'current_capacity')) {
                $table->integer('current_capacity')->default(28)->after('is_featured');
            }
            if (!Schema::hasColumn('locations', 'max_capacity')) {
                $table->integer('max_capacity')->default(80)->after('current_capacity');
            }
            if (!Schema::hasColumn('locations', 'crowd_status')) {
                $table->string('crowd_status')->default('SEPI (35% Kapasitas)')->after('max_capacity');
            }
            if (!Schema::hasColumn('locations', 'distance_text')) {
                $table->string('distance_text')->default('1.2 km dari lokasi Anda')->after('crowd_status');
            }
            if (!Schema::hasColumn('locations', 'hours')) {
                $table->string('hours')->default('24 Jam Nonstop')->after('distance_text');
            }
            if (!Schema::hasColumn('locations', 'phone')) {
                $table->string('phone')->default('0274-556677')->after('hours');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            if (Schema::hasColumn('locations', 'current_capacity')) {
                $table->dropColumn(['current_capacity', 'max_capacity', 'crowd_status', 'distance_text', 'hours', 'phone']);
            }
        });
    }
};
