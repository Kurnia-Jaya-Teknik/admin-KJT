<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\SuratKeteranganRequest;
use App\Models\User;
use Illuminate\Support\Carbon;

// Cari user dengan role karyawan
$karyawan = User::where('role', 'karyawan')->first();

if (!$karyawan) {
    echo "Tidak ada user dengan role karyawan\n";
    exit;
}

echo "Found karyawan: " . $karyawan->name . " (ID: " . $karyawan->id . ")\n\n";

// Buat beberapa test requests
$tomorrowPlus5Days = Carbon::tomorrow()->addDays(5);

$requests = [
    [
        'alasan' => 'Pembukaan Rekening Bank',
        'keperluan' => 'Membuka rekening tabungan di Bank BCA cabang Jakarta Pusat',
        'tanggal_diminta' => $tomorrowPlus5Days->toDateString(),
    ],
    [
        'alasan' => 'Lamaran Kerja',
        'keperluan' => 'Melamar sebagai Senior Developer di perusahaan teknologi',
        'tanggal_diminta' => Carbon::tomorrow()->addDays(7)->toDateString(),
    ],
    [
        'alasan' => 'Visa/Perjalanan',
        'keperluan' => 'Visa kerja untuk Singapura, dokumen untuk embassy',
        'tanggal_diminta' => Carbon::tomorrow()->addDays(10)->toDateString(),
    ],
];

foreach ($requests as $index => $data) {
    $req = SuratKeteranganRequest::create([
        'user_id' => $karyawan->id,
        'alasan' => $data['alasan'],
        'keperluan' => $data['keperluan'],
        'tanggal_diminta' => $data['tanggal_diminta'],
        'status' => 'Pending',
    ]);
    
    echo "✓ Created request #" . ($index + 1) . ": " . $data['alasan'] . " (ID: {$req->id})\n";
}

echo "\n✅ Test surat keterangan requests created successfully!\n";

// Verify
$count = SuratKeteranganRequest::where('user_id', $karyawan->id)->count();
echo "Total requests for {$karyawan->name}: $count\n";
