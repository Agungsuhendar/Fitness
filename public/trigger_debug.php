<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$request = Illuminate\Http\Request::create('/invoice?id=FL-MBR-0018', 'GET', ['id' => 'FL-MBR-0018']);
$controller = new App\Http\Controllers\LeadController();
$response = $controller->showInvoice($request);

echo 'SHOW INVOICE TRIGGERED! LOG CONTENT:
';
if (file_exists(storage_path('logs/ipaymu_debug.log'))) {
    echo file_get_contents(storage_path('logs/ipaymu_debug.log'));
} else {
    echo 'NO LOG FILE FOUND';
}
