<?php

namespace Database\Seeders;

use App\Models\SuratKeteranganRequest;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuratKeteranganRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some karyawan users
        $karyawanList = User::where('role', 'karyawan')
            ->where('status', 'Aktif')
            ->limit(10)
            ->get();

        if ($karyawanList->count() === 0) {
            $this->command->info('No active karyawan found. Create some karyawan first.');
            return;
        }

        $alasan = [
            'Pembukaan Rekening Bank',
            'Lamaran Kerja',
            'Visa/Perjalanan',
            'Administrasi Umum',
            'Kredit Barang',
            'Asuransi',
        ];

        $keperluan = [
            'Diperlukan untuk membuka rekening bank di BCA',
            'Lamaran ke PT Maju Jaya Sejahtera',
            'Visa aplikasi untuk Malaysia',
            'Administrasi izin tinggal',
            'Pengajuan kredit motor di Bank Mandiri',
            'Klaim asuransi kesehatan',
            'Persyaratan pendaftaran sekolah anak',
            'Izin operasional bisnis sampingan',
        ];

        $statuses = ['Pending', 'Approved', 'Rejected', 'Completed'];

        foreach ($karyawanList as $index => $karyawan) {
            for ($i = 0; $i < 3; $i++) {
                SuratKeteranganRequest::create([
                    'user_id' => $karyawan->id,
                    'alasan' => $alasan[array_rand($alasan)],
                    'keperluan' => $keperluan[array_rand($keperluan)],
                    'tanggal_diminta' => now()->addDays(rand(1, 30))->format('Y-m-d'),
                    'status' => $statuses[array_rand($statuses)],
                ]);
            }
        }

        $this->command->info('Surat Keterangan Request dummy data seeded successfully!');
    }
}

