<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$users = \App\Models\User::orderByDesc('id')->take(10)->get();
$payments = \App\Models\Payment::orderByDesc('id')->take(10)->get();

echo "=== USERS ===" . PHP_EOL;
foreach ($users as $u) {
    echo "ID: " . $u->id . " | Name: " . $u->name . " | CardID: " . $u->member_card_id . " | Email: " . $u->email . " | Status: " . $u->status . PHP_EOL;
}

echo "=== PAYMENTS ===" . PHP_EOL;
foreach ($payments as $p) {
    echo "ID: " . $p->id . " | UserID: " . $p->user_id . " | OrderID: " . $p->order_id . " | Status: " . $p->transaction_status . PHP_EOL;
}
