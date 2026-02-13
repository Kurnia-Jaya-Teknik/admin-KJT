<?php
require_once 'bootstrap/autoload.php';
$app = require_once 'bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Cuti;
use App\Models\User;

// Check cuti records
$cutiRecords = Cuti::with('user')->get();

echo "\n=== CUTI RECORDS ===\n";
foreach ($cutiRecords as $cuti) {
    echo "\nID: {$cuti->id}\n";
    echo "Nama Karyawan: {$cuti->user->name}\n";
    echo "Status: {$cuti->status}\n";
    echo "Jenis: {$cuti->jenis}\n";
    echo "Tanggal Mulai: {$cuti->tanggal_mulai}\n";
    echo "Tanggal Selesai: {$cuti->tanggal_selesai}\n";
    echo "File Surat: {$cuti->file_surat}\n";
}

// Check if any disetujui cuti exists
$disetujuiCuti = Cuti::where('status', 'Disetujui')->first();
if ($disetujuiCuti) {
    echo "\n\n=== FIRST DISETUJUI CUTI ===\n";
    echo "ID: {$disetujuiCuti->id}\n";
    echo "Karyawan: {$disetujuiCuti->user->name}\n";
    echo "File Surat: {$disetujuiCuti->file_surat}\n";
    echo "\nTo test: POST /admin/cuti/{$disetujuiCuti->id}/buat-surat\n";
    echo "Then: GET /admin/cuti/{$disetujuiCuti->id}/preview\n";
} else {
    echo "\n\nNo Disetujui cuti found!\n";
}
?>
