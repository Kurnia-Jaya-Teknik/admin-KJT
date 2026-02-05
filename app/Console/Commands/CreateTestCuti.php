<?php

namespace App\Console\Commands;

use App\Models\Cuti;
use App\Models\User;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CreateTestCuti extends Command
{
    /**
     * The name and signature of the artisan command.
     *
     * @var string
     */
    protected $signature = 'create:test-cuti';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membuat data permintaan cuti untuk testing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating test cuti requests...');

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

        // Data permintaan cuti dengan berbagai jenis
        $cutiData = [
            [
                'jenis' => 'Cuti Tahunan',
                'alasan' => 'Liburan keluarga ke Bali',
                'tanggal_mulai' => '2026-02-10',
                'durasi_hari' => 5,
                'status' => 'Disetujui',
            ],
            [
                'jenis' => 'Cuti Sakit',
                'alasan' => 'Sakit demam dan flu',
                'tanggal_mulai' => '2026-02-06',
                'durasi_hari' => 3,
                'status' => 'Disetujui',
            ],
            [
                'jenis' => 'Cuti Tahunan',
                'alasan' => 'Acara pernikahan saudara',
                'tanggal_mulai' => '2026-02-20',
                'durasi_hari' => 2,
                'status' => 'Pending',
            ],
            [
                'jenis' => 'Cuti Darurat',
                'alasan' => 'Keadaan mendesak keluarga',
                'tanggal_mulai' => '2026-02-15',
                'durasi_hari' => 3,
                'status' => 'Disetujui',
            ],
            [
                'jenis' => 'Cuti Tahunan',
                'alasan' => 'Jalan-jalan ke Malaysia',
                'tanggal_mulai' => '2026-03-01',
                'durasi_hari' => 7,
                'status' => 'Pending',
            ],
            [
                'jenis' => 'Cuti Sakit',
                'alasan' => 'Operasi gigi dan follow-up',
                'tanggal_mulai' => '2026-02-08',
                'durasi_hari' => 2,
                'status' => 'Disetujui',
            ],
            [
                'jenis' => 'Cuti Tahunan',
                'alasan' => 'Kunjungan orang tua di kampung halaman',
                'tanggal_mulai' => '2026-02-25',
                'durasi_hari' => 4,
                'status' => 'Ditolak',
            ],
            [
                'jenis' => 'Cuti Darurat',
                'alasan' => 'Berduka cita kematian ayah',
                'tanggal_mulai' => '2026-02-07',
                'durasi_hari' => 3,
                'status' => 'Disetujui',
            ],
        ];

        $createdCount = 0;
        $suratCount = 0;
        foreach ($cutiData as $index => $data) {
            if ($index < $karyawanList->count()) {
                $karyawan = $karyawanList[$index];
                
                // Hitung tanggal selesai
                $tanggalMulai = Carbon::parse($data['tanggal_mulai']);
                $tanggalSelesai = $tanggalMulai->copy()->addDays($data['durasi_hari'] - 1);

                Cuti::create([
                    'user_id' => $karyawan->id,
                    'jenis' => $data['jenis'],
                    'alasan' => $data['alasan'],
                    'tanggal_mulai' => $tanggalMulai,
                    'tanggal_selesai' => $tanggalSelesai,
                    'durasi_hari' => $data['durasi_hari'],
                    'status' => $data['status'],
                ]);

                // Tambahan: generate surat jika sudah disetujui
                if ($data['status'] === 'Disetujui') {
                    $suratCount++;
                }

                $this->line("✓ Created cuti for: {$karyawan->name} - {$data['jenis']} ({$data['durasi_hari']} hari) - Status: {$data['status']}");
                $createdCount++;
            }
        }

        $this->info("\n✅ Successfully created {$createdCount} test cuti requests!");
        $this->info("   ({$suratCount} permintaan siap dibuat suratnya)");
        return Command::SUCCESS;
    }
}
