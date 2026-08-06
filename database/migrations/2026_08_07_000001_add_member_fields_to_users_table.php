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
            $table->string('phone')->nullable()->after('email');
            $table->string('role')->default('member')->after('phone');
            $table->string('member_card_id')->nullable()->after('role');
            $table->string('membership_type')->nullable()->after('member_card_id');
            $table->string('status')->default('active')->after('membership_type');
            $table->string('branch')->nullable()->after('status');
            $table->integer('total_sessions')->default(0)->after('branch');
            $table->integer('completed_sessions')->default(0)->after('total_sessions');
            $table->integer('remaining_sessions')->default(0)->after('completed_sessions');
            $table->string('assigned_coach')->nullable()->after('remaining_sessions');
            $table->string('next_session')->nullable()->after('assigned_coach');
            $table->decimal('initial_weight', 5, 2)->nullable()->after('next_session');
            $table->decimal('current_weight', 5, 2)->nullable()->after('initial_weight');
            $table->decimal('target_weight', 5, 2)->nullable()->after('current_weight');
            $table->decimal('initial_bodyfat', 5, 2)->nullable()->after('target_weight');
            $table->decimal('current_bodyfat', 5, 2)->nullable()->after('initial_bodyfat');
            $table->string('muscle_mass')->nullable()->after('current_bodyfat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'role',
                'member_card_id',
                'membership_type',
                'status',
                'branch',
                'total_sessions',
                'completed_sessions',
                'remaining_sessions',
                'assigned_coach',
                'next_session',
                'initial_weight',
                'current_weight',
                'target_weight',
                'initial_bodyfat',
                'current_bodyfat',
                'muscle_mass',
            ]);
        });
    }
};
