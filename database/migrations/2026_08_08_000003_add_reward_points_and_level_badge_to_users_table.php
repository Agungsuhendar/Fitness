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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'reward_points')) {
                $table->integer('reward_points')->default(3450)->after('remaining_sessions');
            }
            if (!Schema::hasColumn('users', 'level_badge')) {
                $table->string('level_badge')->default('🔥 VIP Platinum')->after('reward_points');
            }
            if (!Schema::hasColumn('users', 'streak_days')) {
                $table->integer('streak_days')->default(14)->after('level_badge');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'reward_points')) {
                $table->dropColumn('reward_points');
            }
            if (Schema::hasColumn('users', 'level_badge')) {
                $table->dropColumn('level_badge');
            }
            if (Schema::hasColumn('users', 'streak_days')) {
                $table->dropColumn('streak_days');
            }
        });
    }
};
