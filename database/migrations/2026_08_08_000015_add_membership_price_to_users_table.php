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
            if (!Schema::hasColumn('users', 'membership_price')) {
                $table->decimal('membership_price', 12, 2)->nullable()->after('membership_type');
            }
            if (!Schema::hasColumn('users', 'payment_method')) {
                $table->string('payment_method')->nullable()->default('Cash (Tunai)')->after('membership_price');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'membership_price')) {
                $table->dropColumn('membership_price');
            }
            if (Schema::hasColumn('users', 'payment_method')) {
                $table->dropColumn('payment_method');
            }
        });
    }
};
