<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Cuti;

$u = User::where('email', 'karyawan@test.com')->first();
if (!$u) {
    echo "User not found: karyawan@test.com\n";
    exit(1);
}

$c = Cuti::create([
    'user_id' => $u->id,
    'jenis' => 'Cuti Tahunan',
    'tanggal_mulai' => date('Y-m-d', strtotime('+2 days')),
    'tanggal_selesai' => date('Y-m-d', strtotime('+4 days')),
    'durasi_hari' => 3,
    'alasan' => 'Test Cuti - inserted by create_test_cuti script',
    'status' => 'Pending',
]);

echo "Created cuti id: " . $c->id . " for user id: " . $u->id . "\n";
