<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo 'VA: ' . App\Models\Setting::get('ipaymu_va', 'NONE') . "
";
echo 'API KEY PREFIX: ' . substr(App\Models\Setting::get('ipaymu_api_key', 'NONE'), 0, 10) . "
";
echo 'IS PROD: ' . App\Models\Setting::get('ipaymu_is_production', 'NONE') . "
";
