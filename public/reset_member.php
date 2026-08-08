<?php
require __DIR__ . "/../vendor/autoload.php";
$app = require_once __DIR__ . "/../bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$user = App\Models\User::where("member_card_id", "FL-MBR-0017")->first();
if ($user) { $user->status = "Pending Verifikasi (Menunggu Scan QRIS)"; $user->save(); echo "MEMBER RESET SUCCESS!"; } else { echo "MEMBER NOT FOUND"; }
