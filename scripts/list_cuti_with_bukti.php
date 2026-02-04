<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$rows = \App\Models\Cuti::whereNotNull('bukti')->get();
if ($rows->isEmpty()) {
    echo "No bukti entries\n";
} else {
    foreach ($rows as $c) {
        echo $c->id . ' | ' . $c->bukti . "\n";
    }
}
