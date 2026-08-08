<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$va = App\Models\Setting::get('ipaymu_va', '0000002447990145');
$apiKey = App\Models\Setting::get('ipaymu_api_key', 'SANDBOX67650-XXXXXXXX-XXXX');
$isProduction = App\Models\Setting::get('ipaymu_is_production', '0') === '1';
$baseUrl = $isProduction ? 'https://my.ipaymu.com' : 'https://sandbox.ipaymu.com';

$id = 'FL-MBR-0020';
$checkEndpoint = $baseUrl . '/api/v2/transaction';
$checkBody = ['referenceId' => $id];
$jsonCheck = json_encode($checkBody, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
$hashCheck = strtolower(hash('sha256', $jsonCheck));
$sigCheck = hash_hmac('sha256', "POST:" . $va . ":" . $hashCheck . ":" . $apiKey, $apiKey);

$checkRes = Illuminate\Support\Facades\Http::timeout(5)->withHeaders([
    'Accept' => 'application/json',
    'Content-Type' => 'application/json',
    'va' => $va,
    'signature' => $sigCheck,
    'timestamp' => date('YmdHis'),
])->post($checkEndpoint, $checkBody);

$output = [
    'endpoint' => $checkEndpoint,
    'va_used' => $va,
    'body_sent' => $checkBody,
    'status_code' => $checkRes->status(),
    'response_body' => $checkRes->json() ?: $checkRes->body()
];

file_put_contents(storage_path('logs/ipaymu_check_debug.json'), json_encode($output, JSON_PRETTY_PRINT));
echo json_encode($output, JSON_PRETTY_PRINT);
