<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: application/json');

$gateway = App\Models\Setting::get('active_payment_gateway', 'midtrans');
$va = App\Models\Setting::get('ipaymu_va', '0000002447990145');
$apiKey = App\Models\Setting::get('ipaymu_api_key', 'SANDBOX67650-XXXXXXXX-XXXX');
$isProd = App\Models\Setting::get('ipaymu_is_production', '0');

$endpoint = $isProd == '1' ? 'https://my.ipaymu.com/api/v2/payment' : 'https://sandbox.ipaymu.com/api/v2/payment';

$body = [
    'name' => 'Bima Member Test',
    'phone' => '081234567890',
    'email' => 'member@fitlife.com',
    'amount' => 300000,
    'notifyUrl' => url('/api/ipaymu/webhook'),
    'returnUrl' => url('/invoice?id=FL-MBR-0018'),
    'cancelUrl' => url('/invoice?id=FL-MBR-0018'),
    'referenceId' => 'FL-MBR-0018',
    'product' => ['Regular Gym Pass'],
    'qty' => [1],
    'price' => [300000],
];

$jsonBody = json_encode($body);
$timestamp = date('YmdHis');
$stringToSign = 'POST:' . $va . ':' . $jsonBody . ':' . $apiKey;
$signature = hash_hmac('sha256', $stringToSign, $apiKey);

try {
    $response = Illuminate\Support\Facades\Http::withHeaders([
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
        'va' => $va,
        'signature' => $signature,
        'timestamp' => $timestamp,
    ])->post($endpoint, $body);

    echo json_encode([
        'active_gateway' => $gateway,
        'ipaymu_va' => $va,
        'ipaymu_api_key' => $apiKey,
        'is_production' => $isProd,
        'http_status' => $response->status(),
        'response_body' => $response->json()
    ]);
} catch (\Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
