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
        if (!Schema::hasTable('membership_plans')) {
            Schema::create('membership_plans', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->unique();
                $table->string('name');
                $table->string('category')->default('monthly'); // daily, monthly, vip, pt_private, student, corporate
                $table->integer('duration_days')->default(30);
                $table->integer('session_count')->nullable(); // for PT private sessions
                $table->integer('price')->default(0);
                $table->integer('promo_price')->nullable();
                $table->string('badge')->nullable(); // e.g. "⚡ Best Seller", "👑 All-Access"
                $table->json('features')->nullable();
                $table->text('description')->nullable();
                $table->boolean('is_active')->default(true);
                $table->integer('order')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_plans');
    }
};
