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
        if (!Schema::hasTable('purchase_orders')) {
            Schema::create('purchase_orders', function (Blueprint $table) {
                $table->id();
                $table->string('po_number')->unique();
                $table->string('supplier_name');
                $table->string('supplier_phone')->nullable();
                $table->date('order_date');
                $table->date('expected_delivery_date')->nullable();
                $table->string('status')->default('draft'); // draft, sent, received, cancelled
                $table->string('payment_status')->default('unpaid'); // unpaid, paid, partial
                $table->decimal('total_amount', 15, 2)->default(0);
                $table->text('notes')->nullable();
                $table->string('created_by')->nullable();
                $table->timestamp('received_at')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('purchase_order_items')) {
            Schema::create('purchase_order_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('purchase_order_id')->constrained('purchase_orders')->onDelete('cascade');
                $table->unsignedBigInteger('product_id')->nullable();
                $table->string('product_name');
                $table->integer('qty_ordered')->default(1);
                $table->integer('qty_received')->default(0);
                $table->decimal('cost_price', 15, 2)->default(0);
                $table->decimal('subtotal', 15, 2)->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_items');
        Schema::dropIfExists('purchase_orders');
    }
};
