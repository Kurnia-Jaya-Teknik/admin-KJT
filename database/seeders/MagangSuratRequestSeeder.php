<?php

namespace Database\Seeders;

use App\Models\Magang;
use App\Models\SuratMagangRequest;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MagangSuratRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user yang ada atau buat yang baru
        $users = User::limit(10)->get();
        
        if ($users->isEmpty()) {
            $this->command->warn('Tidak ada user di database. Silakan jalankan UserSeeder terlebih dahulu.');
            return;
        }

        // ============ REQUEST 1: SMK Negeri 1 Pasuruan (2 siswa) ============
        $req1 = SuratMagangRequest::create([
            'sekolah_asal' => 'SMK Negeri 1 Pasuruan',
            'jumlah_siswa' => 2,
            'keterangan' => 'Permintaan surat magang dari SMK Negeri 1 Pasuruan untuk program praktek industri',
            'status' => 'Pending',
            'tanggal_diminta' => Carbon::now(),
        ]);

        Magang::create([
            'surat_magang_request_id' => $req1->id,
            'user_id' => $users[0]->id,
            'nama_peserta' => 'Rahmat Hidayat',
            'nim_nis' => '2021001',
            'sekolah_asal' => 'SMK Negeri 1 Pasuruan',
            'jurusan' => 'Teknik Komputer dan Jaringan',
            'tanggal_mulai' => Carbon::now()->addDays(5),
            'tanggal_selesai' => Carbon::now()->addDays(35),
            'durasi_hari' => 30,
            'keperluan' => 'Magang praktek industri untuk memenuhi syarat kelulusan program SMK',
            'status' => 'Pending',
            'phone' => '081234567890',
        ]);

        Magang::create([
            'surat_magang_request_id' => $req1->id,
            'user_id' => $users[1]->id,
            'nama_peserta' => 'Siti Nurhaliza',
            'nim_nis' => '2021002',
            'sekolah_asal' => 'SMK Negeri 1 Pasuruan',
            'jurusan' => 'Teknik Komputer dan Jaringan',
            'tanggal_mulai' => Carbon::now()->addDays(5),
            'tanggal_selesai' => Carbon::now()->addDays(35),
            'durasi_hari' => 30,
            'keperluan' => 'Magang praktek industri untuk memenuhi syarat kelulusan program SMK',
            'status' => 'Pending',
            'phone' => '082345678901',
        ]);

        $this->command->info('✓ Permintaan #1 (SMK Negeri 1 Pasuruan - 2 siswa) dibuat');

        // ============ REQUEST 2: SMA Negeri 2 Pasuruan (3 siswa) ============
        $req2 = SuratMagangRequest::create([
            'sekolah_asal' => 'SMA Negeri 2 Pasuruan',
            'jumlah_siswa' => 3,
            'keterangan' => 'Permintaan surat magang dari SMA Negeri 2 Pasuruan untuk penelitian tugas akhir',
            'status' => 'Approved',
            'tanggal_diminta' => Carbon::now()->subDays(5),
        ]);

        Magang::create([
            'surat_magang_request_id' => $req2->id,
            'user_id' => $users[2]->id,
            'nama_peserta' => 'Ahmad Faisal',
            'nim_nis' => '2022001',
            'sekolah_asal' => 'SMA Negeri 2 Pasuruan',
            'jurusan' => 'IPA - Fisika',
            'tanggal_mulai' => Carbon::now()->addDays(10),
            'tanggal_selesai' => Carbon::now()->addDays(40),
            'durasi_hari' => 30,
            'keperluan' => 'Magang untuk penelitian tugas akhir mengenai industri manufaktur',
            'status' => 'Approved',
            'phone' => '083456789012',
            'nomor_surat_diminta' => 'REQ-SMK-002/2026',
            'tanggal_surat_diminta' => Carbon::now()->subDays(5),
        ]);

        Magang::create([
            'surat_magang_request_id' => $req2->id,
            'user_id' => $users[3]->id,
            'nama_peserta' => 'Dewi Lestari',
            'nim_nis' => '2022002',
            'sekolah_asal' => 'SMA Negeri 2 Pasuruan',
            'jurusan' => 'IPA - Kimia',
            'tanggal_mulai' => Carbon::now()->addDays(10),
            'tanggal_selesai' => Carbon::now()->addDays(40),
            'durasi_hari' => 30,
            'keperluan' => 'Magang untuk penelitian tugas akhir mengenai industri manufaktur',
            'status' => 'Approved',
            'phone' => '084567890123',
            'nomor_surat_diminta' => 'REQ-SMK-002/2026',
            'tanggal_surat_diminta' => Carbon::now()->subDays(5),
        ]);

        Magang::create([
            'surat_magang_request_id' => $req2->id,
            'user_id' => $users[4]->id,
            'nama_peserta' => 'Rina Septiana',
            'nim_nis' => '2022003',
            'sekolah_asal' => 'SMA Negeri 2 Pasuruan',
            'jurusan' => 'IPA - Biologi',
            'tanggal_mulai' => Carbon::now()->addDays(10),
            'tanggal_selesai' => Carbon::now()->addDays(40),
            'durasi_hari' => 30,
            'keperluan' => 'Magang untuk penelitian tugas akhir mengenai industri manufaktur',
            'status' => 'Approved',
            'phone' => '085678901234',
            'nomor_surat_diminta' => 'REQ-SMK-002/2026',
            'tanggal_surat_diminta' => Carbon::now()->subDays(5),
        ]);

        $this->command->info('✓ Permintaan #2 (SMA Negeri 2 Pasuruan - 3 siswa) dibuat dengan status APPROVED');

        // ============ REQUEST 3: SMK Swasta Al-Hidayah (2 siswa) ============
        $req3 = SuratMagangRequest::create([
            'sekolah_asal' => 'SMK Swasta Al-Hidayah',
            'jumlah_siswa' => 2,
            'keterangan' => 'Permintaan surat magang dari SMK Swasta Al-Hidayah untuk kompetensi administrasi',
            'status' => 'Pending',
            'tanggal_diminta' => Carbon::now(),
        ]);

        Magang::create([
            'surat_magang_request_id' => $req3->id,
            'user_id' => $users[5]->id,
            'nama_peserta' => 'Fitriana Hasanah',
            'nim_nis' => '2023001',
            'sekolah_asal' => 'SMK Swasta Al-Hidayah',
            'jurusan' => 'Administrasi Perkantoran',
            'tanggal_mulai' => Carbon::now()->addDays(7),
            'tanggal_selesai' => Carbon::now()->addDays(37),
            'durasi_hari' => 30,
            'keperluan' => 'Program magang sekolah untuk menguatkan kompetensi administrasi perkantoran',
            'status' => 'Pending',
            'phone' => '086789012345',
        ]);

        Magang::create([
            'surat_magang_request_id' => $req3->id,
            'user_id' => $users[6]->id,
            'nama_peserta' => 'Budi Santoso',
            'nim_nis' => '2023002',
            'sekolah_asal' => 'SMK Swasta Al-Hidayah',
            'jurusan' => 'Administrasi Perkantoran',
            'tanggal_mulai' => Carbon::now()->addDays(7),
            'tanggal_selesai' => Carbon::now()->addDays(37),
            'durasi_hari' => 30,
            'keperluan' => 'Program magang sekolah untuk menguatkan kompetensi administrasi perkantoran',
            'status' => 'Pending',
            'phone' => '087890123456',
        ]);

        $this->command->info('✓ Permintaan #3 (SMK Swasta Al-Hidayah - 2 siswa) dibuat');

        // ============ REQUEST 4: Universitas Negeri Surabaya (1 siswa) ============
        $req4 = SuratMagangRequest::create([
            'sekolah_asal' => 'Universitas Negeri Surabaya - Teknik Industri',
            'jumlah_siswa' => 1,
            'keterangan' => 'Permintaan surat magang dari Universitas Negeri Surabaya - Teknik Industri',
            'status' => 'Pending',
            'tanggal_diminta' => Carbon::now(),
        ]);

        Magang::create([
            'surat_magang_request_id' => $req4->id,
            'user_id' => $users[7]->id,
            'nama_peserta' => 'Hendra Wijaya',
            'nim_nis' => 'S1-TI-2020-001',
            'sekolah_asal' => 'Universitas Negeri Surabaya - Teknik Industri',
            'jurusan' => 'Teknik Industri S1',
            'tanggal_mulai' => Carbon::now()->addDays(15),
            'tanggal_selesai' => Carbon::now()->addDays(75),
            'durasi_hari' => 60,
            'keperluan' => 'Magang kerja sama program akademik untuk pembelajaran praktik di industri',
            'status' => 'Pending',
            'phone' => '088901234567',
        ]);

        $this->command->info('✓ Permintaan #4 (Universitas Negeri Surabaya - 1 siswa) dibuat');

        // ============ REQUEST 5: Politeknik Negeri Malang (2 siswa - REJECTED) ============
        $req5 = SuratMagangRequest::create([
            'sekolah_asal' => 'Politeknik Negeri Malang',
            'jumlah_siswa' => 2,
            'keterangan' => 'Permintaan surat magang dari Politeknik Negeri Malang - Teknik Mekanika',
            'status' => 'Rejected',
            'tanggal_diminta' => Carbon::now()->subDays(10),
        ]);

        Magang::create([
            'surat_magang_request_id' => $req5->id,
            'user_id' => $users[8]->id,
            'nama_peserta' => 'Rudi Hermawan',
            'nim_nis' => 'D4-TM-2019-001',
            'sekolah_asal' => 'Politeknik Negeri Malang',
            'jurusan' => 'Teknik Mekanika D4',
            'tanggal_mulai' => Carbon::now()->subDays(5),
            'tanggal_selesai' => Carbon::now()->addDays(55),
            'durasi_hari' => 60,
            'keperluan' => 'Program magang diploma untuk kompetensi teknik mekanika lanjut',
            'status' => 'Rejected',
            'phone' => '089012345678',
        ]);

        Magang::create([
            'surat_magang_request_id' => $req5->id,
            'user_id' => $users[9]->id,
            'nama_peserta' => 'Susanto Kurniawan',
            'nim_nis' => 'D4-TM-2019-002',
            'sekolah_asal' => 'Politeknik Negeri Malang',
            'jurusan' => 'Teknik Mekanika D4',
            'tanggal_mulai' => Carbon::now()->subDays(5),
            'tanggal_selesai' => Carbon::now()->addDays(55),
            'durasi_hari' => 60,
            'keperluan' => 'Program magang diploma untuk kompetensi teknik mekanika lanjut',
            'status' => 'Rejected',
            'phone' => '089123456789',
        ]);

        $this->command->info('✓ Permintaan #5 (Politeknik Negeri Malang - 2 siswa) dibuat dengan status REJECTED');

        $this->command->info('✅ Total 5 permintaan surat magang dengan 10 siswa berhasil dibuat!');
    }
}
