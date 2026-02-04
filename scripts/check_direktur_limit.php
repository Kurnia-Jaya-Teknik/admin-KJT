<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo 'MAX=' . config('limits.max_direktur') . "\n";
echo 'COUNT=' . \App\Models\User::where('role','direktur')->where('status','aktif')->count() . "\n";
