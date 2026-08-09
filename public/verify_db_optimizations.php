<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

header('Content-Type: text/html; charset=utf-8');
echo "<h2>🔍 Verifikasi Optimasi Database & Indexing di Server Live...</h2>";

try {
    $dbPath = database_path('database.sqlite');
    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Force create indexes if missing
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_products_active_cat_name ON products(is_active, category, name)");
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_products_code ON products(code)");
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_products_barcode ON products(barcode)");
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_products_track_stock ON products(is_track_stock, stock)");
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_po_status ON purchase_orders(status)");

    // List indexes on products table
    $stmt = $pdo->query("PRAGMA index_list(products)");
    $indexes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h3 style='color: green;'>✅ DAFTAR INDEX TERPASANG PADA TABEL 'PRODUCTS':</h3>";
    echo "<ul>";
    foreach ($indexes as $idx) {
        echo "<li style='font-family: monospace; font-weight: bold;'>" . $idx['name'] . " (Unique: " . ($idx['unique'] ? 'YES' : 'NO') . ")</li>";
    }
    echo "</ul>";

    // Test SQL Aggregate Query Speed
    $start = microtime(true);
    $metrics = DB::table('products')
        ->where('is_active', true)
        ->selectRaw('
            SUM(CASE WHEN COALESCE(is_track_stock, 1) = 1 THEN stock * COALESCE(cost_price, 0) ELSE 0 END) as total_asset_value,
            SUM(CASE WHEN COALESCE(is_track_stock, 1) = 1 THEN stock * price ELSE 0 END) as total_potential_revenue,
            COUNT(CASE WHEN COALESCE(is_track_stock, 1) = 1 AND stock <= 5 THEN 1 END) as low_stock_count
        ')
        ->first();
    $executionTime = round((microtime(true) - $start) * 1000, 2);

    echo "<h3 style='color: #84cc16;'>⚡ UJI KECEPATAN QUERY SQL AGGREGATE ENGINE:</h3>";
    echo "<ul>";
    echo "<li>Waktu Eksekusi Query Database: <strong>$executionTime milidetik (ms)</strong></li>";
    echo "<li>Total Asset Modal: <strong>Rp " . number_format($metrics->total_asset_value ?? 0, 0, ',', '.') . "</strong></li>";
    echo "<li>Estimasi Omset Jual: <strong>Rp " . number_format($metrics->total_potential_revenue ?? 0, 0, ',', '.') . "</strong></li>";
    echo "<li>Produk Stok Menipis (&le; 5): <strong>" . ($metrics->low_stock_count ?? 0) . " Produk</strong></li>";
    echo "</ul>";

    echo "<h2 style='color: green;'>🎉 STATUS: 100% OPTIMASI DB SUDAH NAIK & AKTIF DI SERVER LIVE!</h2>";
} catch (\Throwable $e) {
    echo "<h3 style='color: red;'>❌ Note: " . $e->getMessage() . "</h3>";
}
