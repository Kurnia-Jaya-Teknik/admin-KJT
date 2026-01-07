<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test users with different roles
        User::factory()->create([
            'name' => 'Admin HRD',
            'email' => 'admin@test.com',
            'password' => bcrypt('password123'),
            'role' => 'admin_hrd',
        ]);

        User::factory()->create([
            'name' => 'Direktur',
            'email' => 'direktur@test.com',
            'password' => bcrypt('password123'),
            'role' => 'direktur',
        ]);

        User::factory()->create([
            'name' => 'Karyawan',
            'email' => 'karyawan@test.com',
            'password' => bcrypt('password123'),
            'role' => 'karyawan',
        ]);
    }
}
