<?php

namespace App\Console\Commands;

use App\Models\SuratKeteranganRequest;
use App\Models\User;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CreateTestSuratKeterangan extends Command
{
    /**
     * The name and signature of the artisan command.
     *
     * @var string
     */
    protected $signature = 'create:test-surat-keterangan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membuat data permintaan surat keterangan kerja untuk testing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating test surat keterangan requests...');

        // Ambil daftar karyawan yang aktif
        $karyawanList = User::whereRole('karyawan')
            ->where('status', 'Aktif')
            ->inRandomOrder()
            ->limit(8)
            ->get();

        if ($karyawanList->count() < 5) {
            $this->error('Minimal 5 karyawan aktif diperlukan untuk membuat test data');
            return Command::FAILURE;
        }

        // Data permintaan surat keterangan
        $requestsData = [
            [
                'alasan' => 'Perpanjangan visa kerja ke luar negeri',
                'keperluan' => 'Dibutuhkan untuk proses perpanjangan visa ke Singapura dalam rangka project development',
            ],
            [
                'alasan' => 'Melamar pekerjaan di perusahaan lain',
                'keperluan' => 'Sebagai kelengkapan dokumen lamaran kerja',
            ],
            [
                'alasan' => 'Pendaftaran program sertifikasi internasional',
                'keperluan' => 'Dibutuhkan untuk mendaftar program CISSP di lembaga sertifikasi',
            ],
            [
                'alasan' => 'Pengajuan pinjaman bank',
                'keperluan' => 'Untuk proses verifikasi dokumen pembiayaan rumah',
            ],
            [
                'alasan' => 'Pendaftaran tempat tinggal resmi (KTP)',
                'keperluan' => 'Persyaratan administratif untuk update data kependudukan',
            ],
            [
                'alasan' => 'Pembukaan rekening tabungan baru',
                'keperluan' => 'Sebagai salah satu dokumen persyaratan pembukaan rekening di bank',
            ],
            [
                'alasan' => 'Mengikuti program pelatihan eksternal',
                'keperluan' => 'Sebagai bukti pekerjaan untuk izin mengikuti pelatihan external',
            ],
            [
                'alasan' => 'Pendaftaran beasiswa lanjut studi',
                'keperluan' => 'Dibutuhkan untuk aplikasi beasiswa master degree',
            ],
        ];

        $createdCount = 0;
        foreach ($requestsData as $index => $data) {
            if ($index < $karyawanList->count()) {
                $karyawan = $karyawanList[$index];
                
                SuratKeteranganRequest::create([
                    'user_id' => $karyawan->id,
                    'alasan' => $data['alasan'],
                    'keperluan' => $data['keperluan'],
                    'tanggal_diminta' => Carbon::now()->subDays(rand(1, 15)),
                    'status' => 'Pending',
                ]);

                $this->line("✓ Created request for: {$karyawan->name} - {$data['alasan']}");
                $createdCount++;
            }
        }

        $this->info("\n✅ Successfully created {$createdCount} test surat keterangan requests!");
        return Command::SUCCESS;
    }
}
