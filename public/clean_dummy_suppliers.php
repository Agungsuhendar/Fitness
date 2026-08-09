<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

header('Content-Type: text/html; charset=utf-8');
echo "<h2>🧹 Cleaning Up Dummy Suppliers from Database...</h2>";

try {
    $dummyNames = [
        'PT Sumber Air Mineral (Aqua / Cleo)',
        'PT Nutrisi Kebugaran Indonesia (L-Men & Whey)',
        'CV Perlengkapan Gym & Aksesoris',
        'PT Apparel & Merchandise Studio FitLife'
    ];

    $deleted = DB::table('suppliers')->whereIn('name', $dummyNames)->delete();
    echo "<h3 style='color: green;'>✅ Successfully deleted $deleted dummy supplier records!</h3>";
} catch (\Throwable $e) {
    echo "<h3 style='color: red;'>❌ Cleanup Note: " . $e->getMessage() . "</h3>";
}
