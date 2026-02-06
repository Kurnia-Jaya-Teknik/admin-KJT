<?php
/**
 * Script untuk membuat 7 permintaan magang dengan 2-3 peserta per permintaan
 * 
 * Jalankan dengan: php artisan tinker < create_test_magang.php
 * Atau dari tinker: include 'create_test_magang.php'
 */

use App\Models\SuratMagangRequest;
use App\Models\Magang;
use App\Models\User;
use Carbon\Carbon;

// Ambil atau buat direktur user
$direktur = User::where('role', 'direktur')->first();
if (!$direktur) {
    echo "❌ User direktur tidak ditemukan. Silakan buat user direktur terlebih dahulu.\n";
    exit(1);
}

echo "📝 Membuat 7 permintaan magang dengan 2-3 peserta per permintaan...\n\n";

$sekolahList = [
    ['nama' => 'SMK Negeri 1 Pasuruan', 'kota' => 'Pasuruan', 'jurusan' => 'Teknik Mekatronika'],
    ['nama' => 'SMK Negeri 2 Pasuruan', 'kota' => 'Pasuruan', 'jurusan' => 'Teknik Otomotif'],
    ['nama' => 'SMK Negeri 3 Surabaya', 'kota' => 'Surabaya', 'jurusan' => 'Teknik Listrik'],
    ['nama' => 'SMK Negeri 1 Malang', 'kota' => 'Malang', 'jurusan' => 'Teknik Mesin'],
    ['nama' => 'Universitas Brawijaya', 'kota' => 'Malang', 'jurusan' => 'Teknik Industri'],
    ['nama' => 'Universitas Negeri Surabaya', 'kota' => 'Surabaya', 'jurusan' => 'Teknik Elektronika'],
    ['nama' => 'SMK Negeri 4 Blitar', 'kota' => 'Blitar', 'jurusan' => 'Teknik Mekatronika'],
];

$nama_peserta_list = [
    ['nama' => 'Roni Harapan', 'nis' => 'NIS001'],
    ['nama' => 'Siti Nurhaliza', 'nis' => 'NIS002'],
    ['nama' => 'Budi Santoso', 'nis' => 'NIS003'],
    ['nama' => 'Dewi Lestari', 'nis' => 'NIS004'],
    ['nama' => 'Ahmad Rizki', 'nis' => 'NIS005'],
    ['nama' => 'Maya Wijaya', 'nis' => 'NIS006'],
    ['nama' => 'Eka Pratama', 'nis' => 'NIS007'],
    ['nama' => 'Lina Susanti', 'nis' => 'NIS008'],
    ['nama' => 'Hendra Gunawan', 'nis' => 'NIS009'],
    ['nama' => 'Ani Puspita', 'nis' => 'NIS010'],
    ['nama' => 'Doni Setiawan', 'nis' => 'NIS011'],
    ['nama' => 'Ratna Putri', 'nis' => 'NIS012'],
    ['nama' => 'Imam Santoso', 'nis' => 'NIS013'],
    ['nama' => 'Citra Dewi', 'nis' => 'NIS014'],
    ['nama' => 'Reza Pratama', 'nis' => 'NIS015'],
    ['nama' => 'Bella Fauziah', 'nis' => 'NIS016'],
    ['nama' => 'Joko Prabowo', 'nis' => 'NIS017'],
    ['nama' => 'Siska Maulana', 'nis' => 'NIS018'],
    ['nama' => 'Arman Hidayat', 'nis' => 'NIS019'],
    ['nama' => 'Nita Kusuma', 'nis' => 'NIS020'],
];

$peserta_index = 0;

for ($i = 0; $i < 7; $i++) {
    $sekolah = $sekolahList[$i];
    
    // Tentukan jumlah peserta: 2 atau 3
    $jumlah_peserta = rand(2, 3);
    
    // Buat SuratMagangRequest
    $surat_request = SuratMagangRequest::create([
        'sekolah_asal' => $sekolah['nama'],
        'jumlah_siswa' => $jumlah_peserta,
        'keterangan' => "Permintaan magang untuk siswa jurusan {$sekolah['jurusan']}",
        'status' => 'Pending',
        'tanggal_diminta' => Carbon::now()->subDays(rand(1, 10)),
    ]);
    
    echo "✓ Permintaan #" . ($i+1) . " - {$sekolah['nama']} (ID: {$surat_request->id})\n";
    
    // Buat 2-3 peserta untuk permintaan ini
    for ($j = 0; $j < $jumlah_peserta; $j++) {
        $peserta = $nama_peserta_list[$peserta_index % count($nama_peserta_list)];
        $peserta_index++;
        
        $tanggal_mulai = Carbon::now()->addDays(rand(7, 30));
        $tanggal_selesai = $tanggal_mulai->copy()->addDays(rand(30, 60));
        $durasi = $tanggal_selesai->diffInDays($tanggal_mulai);
        
        $magang = Magang::create([
            'user_id' => $direktur->id,
            'surat_magang_request_id' => $surat_request->id,
            'nama_peserta' => $peserta['nama'],
            'nim_nis' => $peserta['nis'],
            'sekolah_asal' => $sekolah['nama'],
            'jurusan' => $sekolah['jurusan'],
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'durasi_hari' => $durasi,
            'keperluan' => "Memenuhi kebutuhan magang program studi {$sekolah['jurusan']}",
            'phone' => '082' . rand(100000000, 999999999),
            'status' => 'Permintaan Surat',
            'nomor_surat_diminta' => sprintf('001/SMK/%d', ($i + 1)),
            'tanggal_surat_diminta' => Carbon::now(),
        ]);
        
        echo "  └─ Peserta #" . ($j+1) . ": {$peserta['nama']} ({$peserta['nis']})\n";
    }
    echo "\n";
}

echo "✅ Berhasil membuat 7 permintaan magang dengan 2-3 peserta per permintaan!\n";
echo "📊 Total peserta magang: " . Magang::count() . "\n";
