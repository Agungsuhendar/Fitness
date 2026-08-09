<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

header('Content-Type: text/html; charset=utf-8');
echo "<h2>🚀 Executing Database Table Migrations on Live Server...</h2>";

try {
    // 1. Create purchase_orders table
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
        echo "✅ Table 'purchase_orders' CREATED successfully!<br>";
    } else {
        echo "ℹ️ Table 'purchase_orders' ALREADY EXISTS.<br>";
    }

    // 2. Create purchase_order_items table
    if (!Schema::hasTable('purchase_order_items')) {
        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order_id')->constrained('purchase_orders')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('product_name');
            $table->integer('qty_ordered')->default(1);
            $table->integer('qty_received')->default(0);
            $table->decimal('cost_price', 12, 2)->default(0);
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->timestamps();
        });
        echo "✅ Table 'purchase_order_items' CREATED successfully!<br>";
    } else {
        echo "ℹ️ Table 'purchase_order_items' ALREADY EXISTS.<br>";
    }

    // 3. Ensure products table has standard POS columns
    Schema::table('products', function (Blueprint $table) {
        if (!Schema::hasColumn('products', 'barcode')) {
            $table->string('barcode')->nullable()->after('code');
            echo "✅ Column 'barcode' added to 'products'.<br>";
        }
        if (!Schema::hasColumn('products', 'cost_price')) {
            $table->decimal('cost_price', 12, 2)->default(0)->after('price');
            echo "✅ Column 'cost_price' added to 'products'.<br>";
        }
        if (!Schema::hasColumn('products', 'unit')) {
            $table->string('unit')->default('Pcs')->after('stock');
            echo "✅ Column 'unit' added to 'products'.<br>";
        }
        if (!Schema::hasColumn('products', 'description')) {
            $table->text('description')->nullable()->after('unit');
            echo "✅ Column 'description' added to 'products'.<br>";
        }
    });

    echo "<h3 style='color: green;'>🎉 ALL DATABASE TABLES & COLUMNS SUCCESSFULLY CREATED ON LIVE MYSQL!</h3>";
} catch (\Throwable $e) {
    echo "<h3 style='color: red;'>❌ Migration Error: " . $e->getMessage() . "</h3>";
}
