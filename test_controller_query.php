<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== TESTING CONTROLLER QUERIES ===\n\n";

// Test persetujuanCuti query (jenis != 'Ijin Sakit')
echo "1. Persetujuan Cuti (jenis != 'Ijin Sakit'):\n";
$cutiQuery = \App\Models\Cuti::with('user')
    ->where('status', '!=', null)
    ->where('jenis', '!=', 'Ijin Sakit')
    ->get();
echo "   Count: " . $cutiQuery->count() . "\n";
foreach ($cutiQuery as $c) {
    echo "   - ID: {$c->id}, User: {$c->user->name}, Jenis: {$c->jenis}, Status: {$c->status}\n";
}

echo "\n2. Persetujuan Izin Sakit (jenis = 'Ijin Sakit'):\n";
$izinQuery = \App\Models\Cuti::with('user')
    ->where('status', '!=', null)
    ->where('jenis', 'Ijin Sakit')
    ->get();
echo "   Count: " . $izinQuery->count() . "\n";
foreach ($izinQuery as $c) {
    echo "   - ID: {$c->id}, User: {$c->user->name}, Jenis: {$c->jenis}, Status: {$c->status}\n";
}
