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
        if (!Schema::hasTable('nutrition_logs')) {
            Schema::create('nutrition_logs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
                $table->string('member_name')->default('Member VIP FitLife');
                $table->string('meal_name');
                $table->string('meal_type')->default('Makan Siang');
                $table->integer('calories')->default(0);
                $table->integer('protein')->default(0); // in grams
                $table->integer('carbs')->default(0);   // in grams
                $table->integer('fat')->default(0);     // in grams
                $table->boolean('is_ai_scanned')->default(false);
                $table->string('ai_confidence')->nullable();
                $table->date('log_date')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutrition_logs');
    }
};
