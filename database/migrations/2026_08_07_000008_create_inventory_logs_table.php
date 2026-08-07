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
        if (!Schema::hasTable('inventory_logs')) {
            Schema::create('inventory_logs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('set null');
                $table->string('product_name');
                $table->enum('type', ['in', 'out', 'adjustment'])->default('in');
                $table->integer('qty');
                $table->integer('previous_stock')->default(0);
                $table->integer('current_stock')->default(0);
                $table->string('notes')->nullable();
                $table->string('created_by')->default('System');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_logs');
    }
};
