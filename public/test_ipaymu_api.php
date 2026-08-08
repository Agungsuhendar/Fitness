<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$va = App\Models\Setting::get('ipaymu_va', '0000002447990145');
$apiKey = App\Models\Setting::get('ipaymu_api_key', 'SANDBOX67650-XXXXXXXX-XXXX');
$isProduction = App\Models\Setting::get('ipaymu_is_production', '0') === '1';
$baseUrl = $isProduction ? 'https://my.ipaymu.com' : 'https://sandbox.ipaymu.com';

$results = [];

// Test 1: POST /api/v2/transaction with referenceId = FL-MBR-0020
$body1 = ['referenceId' => 'FL-MBR-0020'];
$json1 = json_encode($body1);
$hash1 = strtolower(hash('sha256', $json1));
$sig1 = hash_hmac('sha256', "POST:" . $va . ":" . $hash1 . ":" . $apiKey, $apiKey);

$res1 = Illuminate\Support\Facades\Http::timeout(5)->withHeaders([
    'Accept' => 'application/json',
    'Content-Type' => 'application/json',
    'va' => $va,
    'signature' => $sig1,
    'timestamp' => date('YmdHis'),
])->post($baseUrl . '/api/v2/transaction', $body1);

$results['test1_post_transaction_ref'] = [
    'status' => $res1->status(),
    'body' => $res1->json() ?: $res1->body()
];

// Test 2: POST /api/v2/transaction with transactionId = 223514
$body2 = ['transactionId' => 223514];
$json2 = json_encode($body2);
$hash2 = strtolower(hash('sha256', $json2));
$sig2 = hash_hmac('sha256', "POST:" . $va . ":" . $hash2 . ":" . $apiKey, $apiKey);

$res2 = Illuminate\Support\Facades\Http::timeout(5)->withHeaders([
    'Accept' => 'application/json',
    'Content-Type' => 'application/json',
    'va' => $va,
    'signature' => $sig2,
    'timestamp' => date('YmdHis'),
])->post($baseUrl . '/api/v2/transaction', $body2);

$results['test2_post_transaction_id'] = [
    'status' => $res2->status(),
    'body' => $res2->json() ?: $res2->body()
];

// Test 3: POST /api/v2/transaction without body hash
$sig3 = hash_hmac('sha256', "POST:" . $va . ":" . $json1 . ":" . $apiKey, $apiKey);
$res3 = Illuminate\Support\Facades\Http::timeout(5)->withHeaders([
    'Accept' => 'application/json',
    'Content-Type' => 'application/json',
    'va' => $va,
    'signature' => $sig3,
    'timestamp' => date('YmdHis'),
])->post($baseUrl . '/api/v2/transaction', $body1);

$results['test3_no_hash'] = [
    'status' => $res3->status(),
    'body' => $res3->json() ?: $res3->body()
];

echo json_encode($results, JSON_PRETTY_PRINT);
