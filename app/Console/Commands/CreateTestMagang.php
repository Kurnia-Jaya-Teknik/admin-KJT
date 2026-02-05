<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SuratMagangRequest;
use App\Models\Magang;
use App\Models\User;
use Carbon\Carbon;

class CreateTestMagang extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'create:test-magang';

    /**
     * The console command description.
     */
    protected $description = 'Membuat 7 permintaan magang dengan 2-3 peserta per permintaan untuk testing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Coba cari direktur, jika tidak ada cari admin_hrd
        $direktur = User::where('role', 'direktur')->first();
        
        if (!$direktur) {
            $direktur = User::where('role', 'admin_hrd')->first();
        }
        
        if (!$direktur) {
            $this->error('❌ User direktur atau admin_hrd tidak ditemukan. Silakan buat user terlebih dahulu.');
            return 1;
        }

        $this->info('📝 Membuat 7 permintaan magang dengan 2-3 peserta per permintaan...');
        $this->line('');

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
        $total_magang = 0;

        for ($i = 0; $i < 7; $i++) {
            $sekolah = $sekolahList[$i];
            $jumlah_peserta = rand(2, 3);

            $surat_request = SuratMagangRequest::create([
                'sekolah_asal' => $sekolah['nama'],
                'jumlah_siswa' => $jumlah_peserta,
                'keterangan' => "Permintaan magang untuk siswa jurusan {$sekolah['jurusan']}",
                'status' => 'Pending',
                'tanggal_diminta' => Carbon::now()->subDays(rand(1, 10)),
            ]);

            $this->line("✓ Permintaan #" . ($i + 1) . " - {$sekolah['nama']} (ID: {$surat_request->id})");

            for ($j = 0; $j < $jumlah_peserta; $j++) {
                $peserta = $nama_peserta_list[$peserta_index % count($nama_peserta_list)];
                $peserta_index++;

                $tanggal_mulai = Carbon::now()->addDays(rand(7, 30));
                $tanggal_selesai = $tanggal_mulai->copy()->addDays(rand(30, 60));
                $durasi = $tanggal_selesai->diffInDays($tanggal_mulai);

                Magang::create([
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

                $this->line("  └─ Peserta #" . ($j + 1) . ": {$peserta['nama']} ({$peserta['nis']})");
                $total_magang++;
            }
            $this->line('');
        }

        $this->info('✅ Berhasil membuat 7 permintaan magang dengan 2-3 peserta per permintaan!');
        $this->info('📊 Total peserta magang: ' . Magang::count());
        return 0;
    }
}
