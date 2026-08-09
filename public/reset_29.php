<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = \App\Models\User::where('member_card_id', 'FL-MBR-0029')->first();
if ($user) {
    $user->status = 'Pending Verifikasi (Menunggu Scan QRIS)';
    $user->remaining_sessions = 0;
    $user->save();
    echo 'RESET FL-MBR-0029 TO PENDING SUCCESS';
} else {
    echo 'USER FL-MBR-0029 NOT FOUND';
}
