<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: application/json');

$va = App\Models\Setting::get('ipaymu_va', '0000002447990145');
$apiKey = App\Models\Setting::get('ipaymu_api_key', 'SANDBOX67650-XXXXXXXX-XXXX');
$isProd = App\Models\Setting::get('ipaymu_is_production', '0');

$endpoint = $isProd == '1' 
    ? 'https://my.ipaymu.com/api/v2/payment/direct' 
    : 'https://sandbox.ipaymu.com/api/v2/payment/direct';

$body = [
    'name' => 'Bima Prasetya',
    'phone' => '081234567890',
    'email' => 'bima@member.fitlife',
    'amount' => 300000,
    'notifyUrl' => url('/api/ipaymu/webhook'),
    'paymentMethod' => 'qris',
    'paymentChannel' => 'qris',
    'referenceId' => 'FL-MBR-0018',
    'product' => ['Regular Gym Pass (Bulanan)'],
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
        'va_used' => $va,
        'api_key_used' => $apiKey,
        'endpoint' => $endpoint,
        'http_code' => $response->status(),
        'api_response' => $response->json()
    ], JSON_PRETTY_PRINT);
} catch (\Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
