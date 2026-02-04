<?php

namespace Database\Seeders;

use App\Models\Magang;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TenPermintaanSuratSeeder extends Seeder
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

        $schools = [
            'SMK Negeri 1 Jakarta',
            'SMK Negeri 3 Bandung',
            'Universitas Gunadarma',
            'Politeknik Negeri Bandung',
            'SMKN 2 Surabaya',
        ];

        $jurusans = [
            'Teknik Mesin',
            'Teknik Elektro',
            'Teknik Informatika',
            'Sistem Informasi',
            'Teknik Otomotif',
            'Teknik Permesinan',
        ];

        for ($i = 1; $i <= 10; $i++) {
            $startDate = now()->subMonths($faker->numberBetween(1, 6));
            
            Magang::create([
                'user_id' => $admin->id,
                'nama_peserta' => $faker->name(),
                'nim_nis' => 'NIM' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'sekolah_asal' => $faker->randomElement($schools),
                'jurusan' => $faker->randomElement($jurusans),
                'tanggal_mulai' => $startDate,
                'tanggal_selesai' => $startDate->clone()->addDays($faker->numberBetween(30, 120)),
                'durasi_hari' => $faker->numberBetween(30, 120),
                'keperluan' => $faker->sentence(),
                'phone' => $faker->phoneNumber(),
                'status' => 'Permintaan Surat',
                'nomor_surat_diminta' => 'SR-' . now()->format('Ymd') . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'tanggal_surat_diminta' => now()->subDays($faker->numberBetween(1, 10)),
            ]);
        }

        $this->command->info('✅ 10 Permintaan Surat data created successfully!');
    }
}
