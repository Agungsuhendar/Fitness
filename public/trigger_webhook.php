<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$payload = [
    'trx_id' => 223510,
    'sid' => 'FL-MBR-0020',
    'reference_id' => 'FL-MBR-0020',
    'status' => 'berhasil',
    'status_code' => 1,
    'amount' => '1250000',
    'buyer_name' => 'Anggota Enam',
    'buyer_email' => 'anggota6@fitlife.id',
    'buyer_phone' => '08574322322'
];

$request = Illuminate\Http\Request::create('/api/ipaymu/webhook', 'POST', $payload);
$controller = new App\Http\Controllers\PaymentController();
$response = $controller->handleIpaymuWebhook($request);

echo $response->getContent();
