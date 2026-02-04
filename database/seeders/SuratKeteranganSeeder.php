<?php

namespace Database\Seeders;

use App\Models\SuratKeterangan;
use App\Models\SuratKeteranganRequest;
use App\Models\User;
use App\Models\Departemen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class SuratKeteranganSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Get admin user
        $admin = User::where('role', 'admin_hrd')->first();
        if (!$admin) {
            $this->command->warn('⚠️ No admin_hrd user found. Skipping seeding.');
            return;
        }

        // Get or create departments
        $departments = Departemen::limit(5)->get();
        if ($departments->isEmpty()) {
            // Create departments if none exist
            $deptData = [
                ['nama' => 'IT', 'kode' => 'IT'],
                ['nama' => 'HR', 'kode' => 'HR'],
                ['nama' => 'Finance', 'kode' => 'FIN'],
                ['nama' => 'Marketing', 'kode' => 'MKT'],
                ['nama' => 'Operations', 'kode' => 'OPS'],
            ];
            foreach ($deptData as $data) {
                Departemen::firstOrCreate(['nama' => $data['nama']], $data);
            }
            $departments = Departemen::all();
        }

        // Get existing karyawan or create new ones
        $karyawans = User::where('role', 'karyawan')->get();
        
        if ($karyawans->count() < 15) {
            // Create additional karyawan if needed
            for ($i = $karyawans->count(); $i < 15; $i++) {
                $dept = $departments->random();
                User::create([
                    'name' => $faker->name(),
                    'email' => 'karyawan' . ($i + 1) . '@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'karyawan',
                    'departemen_id' => $dept->id,
                    'jabatan' => $faker->randomElement(['Staff', 'Supervisor', 'Manager']),
                    'tanggal_bergabung' => now()->subYears($faker->numberBetween(1, 5)),
                ]);
            }
            $karyawans = User::where('role', 'karyawan')->get();
        }

        $alasanList = [
            'Cek kesehatan',
            'Keperluan administrasi',
            'Lamaran kerja di perusahaan lain',
            'Permohonan tunjangan',
            'Keperluan bank',
            'Keperluan asuransi',
            'Keperluan pendaftaran',
        ];

        $keperluan = [
            'Untuk keperluan administrasi pribadi',
            'Untuk keperluan lamaran kerja',
            'Untuk keperluan asuransi kesehatan',
            'Untuk keperluan bank',
            'Untuk keperluan visa',
            'Untuk keperluan pendaftaran pendidikan lanjut',
        ];

        // Create requests and their letters
        foreach ($karyawans as $index => $karyawan) {
            // Random status for request: Pending, Approved, Rejected, Completed
            $requestStatus = $faker->randomElement(['Pending', 'Approved', 'Rejected', 'Completed']);
            
            // Create request
            $request = SuratKeteranganRequest::create([
                'user_id' => $karyawan->id,
                'alasan' => $faker->randomElement($alasanList),
                'keperluan' => $faker->randomElement($keperluan),
                'tanggal_diminta' => now()->subDays($faker->numberBetween(1, 30)),
                'status' => $requestStatus,
            ]);

            // Only create letter if request is Approved or Completed
            if (in_array($requestStatus, ['Approved', 'Completed'])) {
                $startDate = $karyawan->tanggal_bergabung ?? now()->subYears(3);
                $dept = Departemen::find($karyawan->departemen_id);
                
                SuratKeterangan::create([
                    'user_id' => $admin->id,
                    'surat_keterangan_request_id' => $request->id,
                    'nomor_surat' => 'SK-' . now()->format('Ymd') . '-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                    'tanggal_surat' => now()->subDays($faker->numberBetween(0, 10)),
                    'jabatan' => $karyawan->jabatan ?? 'Staff',
                    'unit_kerja' => $dept->nama ?? 'Departemen Umum',
                    'tanggal_mulai_kerja' => $startDate,
                    'tanggal_selesai_kerja' => $requestStatus === 'Completed' ? now()->subDays($faker->numberBetween(1, 5)) : null,
                    'keterangan' => $faker->paragraph(),
                    'status' => $requestStatus === 'Completed' ? 'Selesai' : 'Draft',
                ]);
            }
        }

        $this->command->info('✅ Surat Keterangan dummy data created successfully!');
        $this->command->info('  - Karyawan: ' . $karyawans->count());
        $this->command->info('  - Requests: ' . SuratKeteranganRequest::count());
        $this->command->info('  - Letters: ' . SuratKeterangan::count());
    }
}
