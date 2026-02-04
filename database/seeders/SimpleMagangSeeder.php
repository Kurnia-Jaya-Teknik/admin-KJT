<?php

namespace Database\Seeders;

use App\Models\Magang;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SimpleMagangSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        // Get admin user
        $admin = User::where('role', 'admin_hrd')->first();
        
        if (!$admin) {
            $this->command->error('Admin HRD user not found!');
            return;
        }

        $schools = [
            'SMK Negeri 1 Jakarta',
            'SMK Negeri 3 Bandung',
            'Universitas Gunadarma',
            'Politeknik Negeri Bandung',
            'SMK Negeri 2 Surabaya'
        ];

        $jurusans = [
            'Teknik Mesin',
            'Teknik Elektro',
            'Teknik Informatika',
            'Teknik Otomotif',
            'Sistem Informasi',
            'Ilmu Komputer',
            'Manajemen Informatika',
            'Teknik Permesinan'
        ];

        $statuses = ['Permintaan Surat', 'Surat Selesai', 'Disetujui', 'Ditolak'];

        // Create 15 magang entries
        for ($i = 0; $i < 15; $i++) {
            $status = $faker->randomElement($statuses);
            $startDate = now()->subMonths($faker->numberBetween(1, 6));
            
            Magang::create([
                'user_id' => $admin->id,
                'surat_magang_request_id' => null,
                'nama_peserta' => $faker->name(),
                'nim_nis' => 'NIM' . str_pad($faker->numberBetween(10000, 99999), 6, '0', STR_PAD_LEFT),
                'sekolah_asal' => $faker->randomElement($schools),
                'jurusan' => $faker->randomElement($jurusans),
                'tanggal_mulai' => $startDate,
                'tanggal_selesai' => $startDate->clone()->addDays($faker->numberBetween(30, 120)),
                'durasi_hari' => $faker->numberBetween(30, 120),
                'keperluan' => $faker->sentence(),
                'phone' => $faker->phoneNumber(),
                'status' => $status,
                'nomor_surat_diminta' => $faker->numberBetween(100, 999) . '/HRD/' . now()->format('Y'),
                'tanggal_surat_diminta' => now()->subDays($faker->numberBetween(1, 30)),
                'nomor_surat_dibuat' => ($status !== 'Permintaan Surat') ? 'SR-' . now()->format('Ymd') . '-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT) : null,
                'tanggal_surat_dibuat' => ($status !== 'Permintaan Surat') ? now()->subDays($faker->numberBetween(1, 30)) : null,
                'file_surat' => ($status === 'Surat Selesai') ? 'generated/sample_' . time() . '.pdf' : null,
            ]);
        }

        $this->command->info('✅ 15 Magang entries created successfully!');
        $this->command->info('Status breakdown:');
        $this->command->info('  - Permintaan Surat: Need to create letter');
        $this->command->info('  - Surat Selesai: Letter created, can approve/reject');
        $this->command->info('  - Disetujui: Approved');
        $this->command->info('  - Ditolak: Rejected');
    }
}
