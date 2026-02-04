<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Cuti;
use App\Models\User;

$user = User::where('role','karyawan')->first();
if (!$user) { die("No karyawan user found\n"); }

$data = [
    'user_id' => $user->id,
    'jenis' => 'Ijin Sakit',
    'tanggal_mulai' => now()->toDateString(),
    'tanggal_selesai' => now()->toDateString(),
    'durasi_hari' => 1,
    'alasan' => 'Test ijin sakit',
    'status' => 'Pending',
];

$cuti = Cuti::create($data);
echo "Created Cuti ID=".$cuti->id." status=".$cuti->status."\n";
// reload
$cuti2 = Cuti::find($cuti->id);
echo "Reload status=".$cuti2->status."\n";