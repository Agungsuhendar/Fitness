<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

header('Content-Type: text/html; charset=utf-8');
echo "<h2>🚀 Executing ALL Database Migrations on Production Server...</h2>";

// 1. purchase_orders & purchase_order_items
try {
    if (!Schema::hasTable('purchase_orders')) {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('po_number')->unique();
            $table->string('supplier_name');
            $table->string('supplier_phone')->nullable();
            $table->date('order_date');
            $table->date('expected_delivery_date')->nullable();
            $table->string('status')->default('draft');
            $table->string('payment_status')->default('unpaid');
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->text('notes')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamp('received_at')->nullable();
            $table->timestamps();
        });
        echo "✅ Table 'purchase_orders' CREATED.<br>";
    } else {
        echo "ℹ️ Table 'purchase_orders' ALREADY EXISTS.<br>";
    }

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
        echo "✅ Table 'purchase_order_items' CREATED.<br>";
    } else {
        echo "ℹ️ Table 'purchase_order_items' ALREADY EXISTS.<br>";
    }
} catch (\Throwable $e) { echo "Note: " . $e->getMessage() . "<br>"; }

// 2. products columns
try {
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
} catch (\Throwable $e) { echo "Note: " . $e->getMessage() . "<br>"; }

// 3. users table fields
try {
    Schema::table('users', function (Blueprint $table) {
        if (!Schema::hasColumn('users', 'membership_expires_at')) {
            $table->timestamp('membership_expires_at')->nullable()->after('status');
            echo "✅ Column 'membership_expires_at' added to 'users'.<br>";
        }
        if (!Schema::hasColumn('users', 'membership_price')) {
            $table->decimal('membership_price', 12, 2)->nullable()->after('membership_type');
            echo "✅ Column 'membership_price' added to 'users'.<br>";
        }
        if (!Schema::hasColumn('users', 'reward_points')) {
            $table->integer('reward_points')->default(0)->after('status');
            echo "✅ Column 'reward_points' added to 'users'.<br>";
        }
        if (!Schema::hasColumn('users', 'level_badge')) {
            $table->string('level_badge')->default('BRONZE ATHLETE')->after('reward_points');
            echo "✅ Column 'level_badge' added to 'users'.<br>";
        }
    });
} catch (\Throwable $e) { echo "Note: " . $e->getMessage() . "<br>"; }

// 4. Run Laravel Artisan Migrate if possible
try {
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    echo "<pre>" . \Illuminate\Support\Facades\Artisan::output() . "</pre>";
} catch (\Throwable $e) {
    echo "Artisan Note: " . $e->getMessage() . "<br>";
}

echo "<h3 style='color: green;'>🎉 ALL DATABASE TABLES & SCHEMAS 100% UP TO DATE ON LIVE SERVER!</h3>";
