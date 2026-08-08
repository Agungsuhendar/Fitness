<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$controller = new App\Http\Controllers\PaymentController();
$request = Illuminate\Http\Request::create('/test-qris-api', 'GET');
$response = $controller->testQrisApi($request);

file_put_contents(__DIR__ . '/../storage/logs/qris_result.json', $response->getContent());
echo 'LOGGED QRIS RESPONSE SUCCESSFULLY!';
