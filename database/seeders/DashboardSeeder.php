<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Departemen;
use App\Models\Absensi;
use App\Models\Cuti;
use App\Models\Lembur;
use App\Models\Surat;
use Illuminate\Support\Facades\Hash;

class DashboardSeeder extends Seeder
{
    public function run(): void
    {
        // Create Departments
        $departments = [
            ['nama' => 'IT', 'kode' => 'IT', 'deskripsi' => 'Departemen Teknologi Informasi'],
            ['nama' => 'Marketing', 'kode' => 'MKT', 'deskripsi' => 'Departemen Marketing'],
            ['nama' => 'Finance', 'kode' => 'FIN', 'deskripsi' => 'Departemen Keuangan'],
            ['nama' => 'HR', 'kode' => 'HR', 'deskripsi' => 'Departemen Human Resources'],
            ['nama' => 'Operations', 'kode' => 'OPS', 'deskripsi' => 'Departemen Operasional'],
        ];

        foreach ($departments as $dept) {
            Departemen::create($dept);
        }

        // Create sample employees
        $statusKontrak = ['PKWTT', 'PKWT', 'Magang'];
        for ($i = 1; $i <= 50; $i++) {
            User::create([
                'name' => 'Karyawan ' . $i,
                'email' => 'karyawan' . $i . '@kjt.com',
                'password' => Hash::make('password'),
                'role' => 'karyawan',
                'departemen_id' => rand(1, 5),
                'status_kontrak' => $statusKontrak[array_rand($statusKontrak)],
                'sisa_cuti' => rand(5, 12),
            ]);
        }

        // Create absensi for last 30 days
        $users = User::where('role', 'karyawan')->get();
        $statuses = ['Hadir', 'Hadir', 'Hadir', 'Hadir', 'Izin', 'Sakit'];
        
        for ($day = 30; $day >= 0; $day--) {
            $tanggal = now()->subDays($day);
            
            // Skip weekends
            if ($tanggal->isWeekend()) continue;
            
            foreach ($users->random(rand(45, 50)) as $user) {
                Absensi::create([
                    'user_id' => $user->id,
                    'tanggal' => $tanggal,
                    'jam_masuk' => '08:' . rand(0, 30),
                    'jam_keluar' => '17:' . rand(0, 30),
                    'status' => $statuses[array_rand($statuses)],
                ]);
            }
        }

        // Create cuti applications
        $jenisCuti = ['Cuti Tahunan', 'Cuti Sakit', 'Cuti Darurat'];
        $statusCuti = ['Pending', 'Disetujui', 'Ditolak'];
        
        for ($i = 0; $i < 20; $i++) {
            $user = $users->random();
            $status = $statusCuti[array_rand($statusCuti)];
            $tanggalMulai = now()->addDays(rand(1, 30));
            $durasi = rand(1, 5);
            
            Cuti::create([
                'user_id' => $user->id,
                'jenis' => $jenisCuti[array_rand($jenisCuti)],
                'tanggal_mulai' => $tanggalMulai,
                'tanggal_selesai' => $tanggalMulai->copy()->addDays($durasi),
                'durasi_hari' => $durasi,
                'alasan' => 'Keperluan pribadi',
                'status' => $status,
                'disetujui_oleh' => $status !== 'Pending' ? 1 : null,
                'tanggal_persetujuan' => $status !== 'Pending' ? now() : null,
            ]);
        }

        // Create lembur applications
        $statusLembur = ['Pending', 'Disetujui', 'Ditolak'];
        
        for ($i = 0; $i < 15; $i++) {
            $user = $users->random();
            $status = $statusLembur[array_rand($statusLembur)];
            $durasi = rand(2, 8);
            
            Lembur::create([
                'user_id' => $user->id,
                'tanggal' => now()->subDays(rand(1, 10)),
                'jam_mulai' => '18:00',
                'jam_selesai' => (18 + $durasi) . ':00',
                'durasi_jam' => $durasi,
                'keterangan' => 'Menyelesaikan project',
                'status' => $status,
                'disetujui_oleh' => $status !== 'Pending' ? 1 : null,
                'tanggal_persetujuan' => $status !== 'Pending' ? now() : null,
            ]);
        }

        // Create surat
        $jenisSurat = ['Surat Rekomendasi', 'Surat Keterangan', 'Surat Tanggung Jawab', 'Surat Lainnya'];
        $statusSurat = ['Draft', 'Menunggu Persetujuan', 'Disetujui', 'Ditolak', 'Diterbitkan'];
        
        for ($i = 1; $i <= 25; $i++) {
            $user = $users->random();
            $status = $statusSurat[array_rand($statusSurat)];
            
            Surat::create([
                'user_id' => $user->id,
                'jenis' => $jenisSurat[array_rand($jenisSurat)],
                'nomor_surat' => 'SRT/' . now()->format('Y') . '/' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'perihal' => 'Perihal Surat ' . $i,
                'isi_surat' => 'Isi surat nomor ' . $i,
                'tanggal_surat' => now()->subDays(rand(1, 30)),
                'status' => $status,
                'dibuat_oleh' => 1,
                'disetujui_oleh' => in_array($status, ['Disetujui', 'Diterbitkan']) ? 1 : null,
                'tanggal_persetujuan' => in_array($status, ['Disetujui', 'Diterbitkan']) ? now() : null,
            ]);
        }
    }
}
