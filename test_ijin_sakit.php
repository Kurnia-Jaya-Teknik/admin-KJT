<?php
require 'vendor/autoload.php';

use App\Models\User;
use App\Models\Cuti;

$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Ambil user pertama (karyawan)
$user = User::where('role', 'karyawan')->first();

if (!$user) {
    die("Tidak ada user dengan role karyawan\n");
}

echo "Testing dengan user: " . $user->email . " (ID: " . $user->id . ")\n\n";

// Buat beberapa test data ijin sakit
$dates = [
    ['2026-01-20', '2026-01-20', 'Ijin untuk check up kesehatan'],
    ['2026-01-21', '2026-01-21', 'Ijin sakit demam'],
    ['2026-01-22', '2026-01-22', 'Ijin sakit headache'],
];

foreach ($dates as $idx => $data) {
    $status = ($idx === 0) ? 'Disetujui' : (($idx === 1) ? 'Menunggu' : 'Ditolak');
    $num = $idx + 1;
    
    $cuti = Cuti::create([
        'user_id' => $user->id,
        'jenis' => 'Ijin Sakit',
        'tanggal_mulai' => $data[0],
        'tanggal_selesai' => $data[1],
        'durasi_hari' => 1,
        'alasan' => $data[2],
        'status' => $status,
        'keterangan_persetujuan' => 'Test data - ' . $num,
    ]);
    
    echo "Created Ijin Sakit #$num: {$data[2]} (Status: {$cuti->status})\n";
}

echo "\nTest data created successfully!\n";
echo "Now visit http://localhost/Admin-KJT/public/karyawan/ijin-sakit to see the history\n";
echo "Login with the karyawan account first\n";
?>
