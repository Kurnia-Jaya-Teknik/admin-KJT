<?php

namespace Database\Seeders;

use App\Models\Magang;
use App\Models\SuratMagangRequest;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MagangGroupedSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Get admin user for linking, or create if not exists
        $admin = User::where('role', 'admin_hrd')->first();
        
        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin HRD',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role' => 'admin_hrd',
            ]);
        }

        // Schools and their data
        $schools = [
            [
                'name' => 'SMK Negeri 1 Jakarta',
                'jurusans' => ['Teknik Mesin', 'Teknik Elektro', 'Teknik Informatika'],
                'batches' => 3,
            ],
            [
                'name' => 'SMK Negeri 3 Bandung',
                'jurusans' => ['Teknik Otomotif', 'Teknik Permesinan'],
                'batches' => 2,
            ],
            [
                'name' => 'Universitas Gunadarma',
                'jurusans' => ['Sistem Informasi', 'Teknik Informatika', 'Ilmu Komputer'],
                'batches' => 2,
            ],
            [
                'name' => 'Politeknik Negeri Bandung',
                'jurusans' => ['Teknik Elektro', 'Teknik Mesin'],
                'batches' => 2,
            ],
        ];

        foreach ($schools as $school) {
            // Create 2-3 batches (requests) per school
            $numBatches = $faker->numberBetween($school['batches'] - 1, $school['batches']);
            
            for ($batch = 0; $batch < $numBatches; $batch++) {
                // Create SuratMagangRequest (group request)
                $request = SuratMagangRequest::create([
                    'sekolah_asal' => $school['name'],
                    'jumlah_siswa' => $faker->numberBetween(2, 3), // 2-3 students per request
                    'keterangan' => $faker->sentence(),
                    'status' => $faker->randomElement(['Disetujui', 'Ditolak', 'Menunggu']),
                    'tanggal_diminta' => now()->subDays($faker->numberBetween(5, 60)),
                ]);

                // Create 2-3 Magang entries for this request
                $numStudents = $faker->numberBetween(2, 3);
                
                for ($i = 0; $i < $numStudents; $i++) {
                    $startDate = now()->subMonths($faker->numberBetween(1, 3));
                    
                    // Random status: Permintaan Surat (need to create letter), Surat Selesai (letter created), Disetujui, or Ditolak
                    $status = $faker->randomElement(['Permintaan Surat', 'Surat Selesai', 'Disetujui', 'Ditolak']);
                    
                    Magang::create([
                        'user_id' => $admin->id,
                        'surat_magang_request_id' => $request->id,
                        'nama_peserta' => $faker->name(),
                        'nim_nis' => 'NIM' . str_pad($faker->numberBetween(10000, 99999), 6, '0', STR_PAD_LEFT),
                        'sekolah_asal' => $school['name'],
                        'jurusan' => $faker->randomElement($school['jurusans']),
                        'tanggal_mulai' => $startDate,
                        'tanggal_selesai' => $startDate->clone()->addDays($faker->numberBetween(30, 120)),
                        'durasi_hari' => $faker->numberBetween(30, 120),
                        'keperluan' => $faker->sentence(),
                        'phone' => $faker->phoneNumber(),
                        'status' => $status,
                        'nomor_surat_dibuat' => ($status !== 'Permintaan Surat') ? 'SR-' . now()->format('Ymd') . '-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT) : null,
                        'tanggal_surat_dibuat' => ($status !== 'Permintaan Surat') ? now()->subDays($faker->numberBetween(1, 30)) : null,
                        'file_surat' => ($status === 'Surat Selesai') ? 'generated/sample_' . time() . '.pdf' : null,
                    ]);
                }
            }
        }

        $this->command->info('✅ Grouped magang data created successfully!');
        $this->command->info('Schools with multiple student requests:');
        $this->command->info('  - SMK Negeri 1 Jakarta: 3 batch requests');
        $this->command->info('  - SMK Negeri 3 Bandung: 2 batch requests');
        $this->command->info('  - Universitas Gunadarma: 2 batch requests');
        $this->command->info('  - Politeknik Negeri Bandung: 2 batch requests');
    }
}
