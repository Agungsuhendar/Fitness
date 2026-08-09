<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

echo "<h3>Running DB Schema Migration for POS Products Table...</h3>";

try {
    Schema::table('products', function (Blueprint $table) {
        if (!Schema::hasColumn('products', 'barcode')) {
            $table->string('barcode')->nullable()->after('code');
            echo "Added column: barcode<br>";
        }
        if (!Schema::hasColumn('products', 'cost_price')) {
            $table->decimal('cost_price', 12, 2)->default(0)->after('price');
            echo "Added column: cost_price<br>";
        }
        if (!Schema::hasColumn('products', 'unit')) {
            $table->string('unit')->default('Pcs')->after('stock');
            echo "Added column: unit<br>";
        }
        if (!Schema::hasColumn('products', 'description')) {
            $table->text('description')->nullable()->after('unit');
            echo "Added column: description<br>";
        }
    });
    echo "<h4 style='color: green;'>MIGRATION SUCCESSFUL! Database Schema Updated.</h4>";
} catch (\Exception $e) {
    echo "<h4 style='color: red;'>Migration Note: " . $e->getMessage() . "</h4>";
}
