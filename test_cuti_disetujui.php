<?php
require_once __DIR__ . '/bootstrap/app.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Cuti;
use Illuminate\Support\Facades\DB;

$cutiDisetujui = Cuti::where('status', 'Disetujui')->with('user')->take(5)->get();

echo "\n=== CUTI YANG SUDAH DISETUJUI ===\n";
foreach ($cutiDisetujui as $cuti) {
    echo "ID: {$cuti->id}, Karyawan: {$cuti->user->name}, Jenis: {$cuti->jenis}, File: {$cuti->file_surat}\n";
}
