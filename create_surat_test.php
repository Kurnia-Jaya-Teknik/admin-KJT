<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\SuratKeterangan;
use App\Models\User;
use Illuminate\Support\Carbon;

// Cari user dengan role karyawan
$karyawan = User::where('role', 'karyawan')->first();

if (!$karyawan) {
    echo "Tidak ada user dengan role karyawan\n";
    exit;
}

echo "Found karyawan: " . $karyawan->name . " (ID: " . $karyawan->id . ")\n\n";

// Hapus surat lama (jika ada)
SuratKeterangan::where('user_id', $karyawan->id)->delete();
echo "Cleared old surat data\n\n";

// Buat 3 surat keterangan dengan is_sent = true
for ($i = 1; $i <= 3; $i++) {
    $surat = SuratKeterangan::create([
        'user_id' => $karyawan->id,
        'nomor_surat' => 'SK/2026/0' . $i . '/' . strtoupper(substr($karyawan->name, 0, 3)),
        'jabatan' => 'Software Developer',
        'unit_kerja' => 'IT & Teknologi',
        'tanggal_mulai_kerja' => Carbon::parse('2020-01-15')->toDateString(),
        'keterangan' => 'Surat keterangan kerja untuk keperluan ' . ['perumahan', 'pinjaman bank', 'visa'][rand(0, 2)],
        'tanggal_surat' => Carbon::now()->subDays(rand(1, 10))->toDateString(),
        'file_surat' => 'surat/test_' . $i . '.pdf', // Dummy path
        'is_sent' => true,
        'sent_at' => Carbon::now()->subDays(rand(0, 5))->subHours(rand(1, 23)),
        'sent_notes' => 'Surat dikirim via sistem',
    ]);
    
    echo "Created surat #{$i}: " . $surat->nomor_surat . " (sent_at: " . $surat->sent_at . ")\n";
}

echo "\nSuratKeterangan data created successfully!\n";

// Verify
$count = SuratKeterangan::where('user_id', $karyawan->id)->where('is_sent', true)->count();
echo "Verified: $count surat dengan is_sent=true untuk user " . $karyawan->name . "\n";
