<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Departemen;
use App\Models\Cuti;
use App\Models\Lembur;
use App\Models\Absensi;
use App\Models\Surat;
use App\Models\SuratTemplate;
use App\Models\Magang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DummyDataSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // 1. Create Departments
        $departments = [];
        $departemenNames = ['Mekanik', 'Elektrik', 'Cleaning', 'IT', 'Finance', 'Operations'];
        foreach ($departemenNames as $name) {
            $departments[] = Departemen::create([
                'kode' => strtolower(str_replace(' ', '_', $name)),
                'nama' => $name,
            ]);
        }

        // 2. Create Admin & Direktur
        $admin = User::updateOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Admin HRD',
                'password' => bcrypt('password123'),
                'role' => 'admin_hrd',
                'status_kontrak' => 'PKWTT',
                'sisa_cuti' => 12,
            ]
        );

        $direktur = User::updateOrCreate(
            ['email' => 'direktur@test.com'],
            [
                'name' => 'Direktur',
                'password' => bcrypt('password123'),
                'role' => 'direktur',
                'status_kontrak' => 'PKWTT',
                'sisa_cuti' => 12,
            ]
        );

        // 3. Create Karyawan (20 employees)
        $karyawanList = [];
        for ($i = 1; $i <= 20; $i++) {
            $karyawan = User::updateOrCreate(
                ['email' => "karyawan{$i}@test.com"],
                [
                    'name' => $faker->name(),
                    'password' => bcrypt('password123'),
                    'role' => 'karyawan',
                    'departemen_id' => $departments[$i % count($departments)]->id,
                    'status_kontrak' => $faker->randomElement(['PKWT', 'PKWTT', 'Magang']),
                    'sisa_cuti' => $faker->randomElement([8, 10, 12, 15, 18]),
                ]
            );
            $karyawanList[] = $karyawan;
        }

        // 4. Create Absensi (Attendance data for this month)
        $today = now();
        $startOfMonth = $today->clone()->startOfMonth();
        $endOfMonth = $today->clone()->endOfMonth();

        for ($date = $startOfMonth; $date <= $endOfMonth; $date->addDay()) {
            // Skip weekends
            if ($date->isWeekend()) {
                continue;
            }

            // 80% of employees present
            foreach ($karyawanList as $karyawan) {
                if ($faker->randomFloat(1, 0, 1) > 0.2) { // 80% present
                    Absensi::updateOrCreate(
                        [
                            'user_id' => $karyawan->id,
                            'tanggal' => $date->format('Y-m-d'),
                        ],
                        [
                            'status' => 'Hadir',
                            'jam_masuk' => $faker->time('H:i:s', '08:00:00', '09:30:00'),
                            'jam_keluar' => $faker->time('H:i:s', '16:00:00', '17:30:00'),
                        ]
                    );
                } else {
                    // 20% absent
                    Absensi::updateOrCreate(
                        [
                            'user_id' => $karyawan->id,
                            'tanggal' => $date->format('Y-m-d'),
                        ],
                        [
                            'status' => $faker->randomElement(['Alpa', 'Izin', 'Sakit', 'Cuti']),
                        ]
                    );
                }
            }
        }

        // 5. Create Cuti (Leave requests)
        $cutiStatuses = ['Pending', 'Disetujui', 'Ditolak'];
        for ($i = 0; $i < 15; $i++) {
            $startDate = now()->subDays($faker->numberBetween(5, 60));
            Cuti::create([
                'user_id' => $karyawanList[$faker->numberBetween(0, count($karyawanList) - 1)]->id,
                'jenis' => $faker->randomElement(['Cuti Tahunan', 'Cuti Sakit', 'Cuti Darurat']),
                'durasi_hari' => $faker->numberBetween(1, 7),
                'tanggal_mulai' => $startDate,
                'tanggal_selesai' => $startDate->clone()->addDays($faker->numberBetween(1, 7)),
                'alasan' => $faker->sentence(),
                'status' => $faker->randomElement($cutiStatuses),
                'tanggal_persetujuan' => $faker->randomElement($cutiStatuses) !== 'Pending' ? now()->subDays($faker->numberBetween(1, 30)) : null,
            ]);
        }

        // 6. Create Lembur (Overtime requests)
        $lemburStatuses = ['Pending', 'Disetujui', 'Ditolak'];
        for ($i = 0; $i < 12; $i++) {
            $tanggal = now()->subDays($faker->numberBetween(1, 60));
            Lembur::create([
                'user_id' => $karyawanList[$faker->numberBetween(0, count($karyawanList) - 1)]->id,
                'tanggal' => $tanggal,
                'jam_mulai' => $faker->time('H:i:s', '17:00:00', '18:00:00'),
                'jam_selesai' => $faker->time('H:i:s', '20:00:00', '21:00:00'),
                'durasi_jam' => $faker->numberBetween(2, 5),
                'keterangan' => $faker->sentence(),
                'status' => $faker->randomElement($lemburStatuses),
                'tanggal_persetujuan' => $faker->randomElement($lemburStatuses) !== 'Pending' ? now()->subDays($faker->numberBetween(1, 30)) : null,
            ]);
        }

        // 7. Create Surat (Letters)
        $suratStatuses = ['Draft', 'Menunggu Persetujuan', 'Disetujui', 'Diterbitkan', 'Ditolak'];
        $suratJenis = ['Surat Rekomendasi', 'Surat Keterangan', 'Surat Tanggung Jawab', 'Surat Lainnya'];
        for ($i = 0; $i < 20; $i++) {
            $status = $faker->randomElement($suratStatuses);
            Surat::create([
                'user_id' => $karyawanList[$faker->numberBetween(0, count($karyawanList) - 1)]->id,
                'jenis' => $faker->randomElement($suratJenis),
                'nomor_surat' => 'SR-' . now()->format('Ymd') . '-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'perihal' => $faker->sentence(5),
                'isi_surat' => $faker->paragraph(),
                'tanggal_surat' => now()->subDays($faker->numberBetween(1, 60)),
                'dibuat_oleh' => $admin->id,
                'status' => $status,
                'tanggal_persetujuan' => in_array($status, ['Disetujui', 'Diterbitkan']) ? now()->subDays($faker->numberBetween(1, 20)) : null,
                'disetujui_oleh' => in_array($status, ['Disetujui', 'Diterbitkan']) ? $direktur->id : null,
            ]);
        }

        // 8. Create Magang (Internship)
        for ($i = 0; $i < 8; $i++) {
            $startDate = now()->subMonths($faker->numberBetween(1, 4));
            Magang::create([
                'user_id' => $karyawanList[$faker->numberBetween(0, count($karyawanList) - 1)]->id,
                'nama_peserta' => $faker->name(),
                'nim_nis' => 'NIM' . str_pad($i + 1, 6, '0', STR_PAD_LEFT),
                'sekolah_asal' => $faker->company(),
                'jurusan' => $faker->word(),
                'durasi_hari' => $faker->numberBetween(30, 120),
                'tanggal_mulai' => $startDate,
                'tanggal_selesai' => $startDate->clone()->addMonths($faker->numberBetween(1, 3)),
                'keperluan' => $faker->sentence(),
                'phone' => $faker->phoneNumber(),
                'status' => $faker->randomElement(['Pending', 'Disetujui', 'Ditolak']),
            ]);
        }

        $this->command->info('✅ Dummy data created successfully!');
        $this->command->info('Test Accounts:');
        $this->command->info('  Admin HRD: admin@test.com / password123');
        $this->command->info('  Direktur: direktur@test.com / password123');
        $this->command->info('  Karyawan: karyawan1@test.com to karyawan20@test.com / password123');
    }
}
