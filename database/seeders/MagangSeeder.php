<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Magang;
use Carbon\Carbon;

class MagangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TEST 1: Satu peserta saja dari SMK Negeri 1 Pasuruan
        Magang::create([
            'nama_peserta' => 'Budi Santoso',
            'sekolah_asal' => 'SMK Negeri 1 Pasuruan',
            'jurusan' => 'Teknik Mesin',
            'tanggal_mulai' => Carbon::now()->addDays(5),
            'tanggal_selesai' => Carbon::now()->addDays(35),
            'durasi_hari' => 30,
            'keperluan' => 'Program magang kurikulum sekolah',
            'status' => 'Permintaan Surat',
            'phone' => '082345678901',
            'user_id' => 1,
        ]);

        // TEST 2: Dua peserta dari SMK Muhammadiyah Pasuruan (akan digroup jadi 1 surat)
        Magang::create([
            'nama_peserta' => 'Rina Wijaya',
            'sekolah_asal' => 'SMK Muhammadiyah Pasuruan',
            'jurusan' => 'Teknik Elektro',
            'tanggal_mulai' => Carbon::now()->addDays(8),
            'tanggal_selesai' => Carbon::now()->addDays(38),
            'durasi_hari' => 30,
            'keperluan' => 'Program magang kurikulum sekolah',
            'status' => 'Permintaan Surat',
            'phone' => '081234567890',
            'user_id' => 1,
        ]);

        Magang::create([
            'nama_peserta' => 'Doni Hermawan',
            'sekolah_asal' => 'SMK Muhammadiyah Pasuruan',
            'jurusan' => 'Teknik Otomasi',
            'tanggal_mulai' => Carbon::now()->addDays(8),
            'tanggal_selesai' => Carbon::now()->addDays(38),
            'durasi_hari' => 30,
            'keperluan' => 'Program magang kurikulum sekolah',
            'status' => 'Permintaan Surat',
            'phone' => '082567891234',
            'user_id' => 1,
        ]);

        // TEST 3: Tiga peserta dari Politeknik Negeri Malang (akan digroup jadi 1 surat)
        Magang::create([
            'nama_peserta' => 'Ahmad Rizki',
            'sekolah_asal' => 'Politeknik Negeri Malang',
            'jurusan' => 'Teknik Otomasi Industri',
            'tanggal_mulai' => Carbon::now()->addDays(10),
            'tanggal_selesai' => Carbon::now()->addDays(40),
            'durasi_hari' => 30,
            'keperluan' => 'Program magang kurikulum sekolah',
            'status' => 'Permintaan Surat',
            'phone' => '082112233445',
            'user_id' => 1,
        ]);

        Magang::create([
            'nama_peserta' => 'Siti Nurhaliza',
            'sekolah_asal' => 'Politeknik Negeri Malang',
            'jurusan' => 'Teknik Elektro Industri',
            'tanggal_mulai' => Carbon::now()->addDays(10),
            'tanggal_selesai' => Carbon::now()->addDays(40),
            'durasi_hari' => 30,
            'keperluan' => 'Program magang kurikulum sekolah',
            'status' => 'Permintaan Surat',
            'phone' => '081555666777',
            'user_id' => 1,
        ]);

        Magang::create([
            'nama_peserta' => 'Melisa Putri',
            'sekolah_asal' => 'Politeknik Negeri Malang',
            'jurusan' => 'Teknik Mekatronika',
            'tanggal_mulai' => Carbon::now()->addDays(10),
            'tanggal_selesai' => Carbon::now()->addDays(40),
            'durasi_hari' => 30,
            'keperluan' => 'Program magang kurikulum sekolah',
            'status' => 'Permintaan Surat',
            'phone' => '081777888999',
            'user_id' => 1,
        ]);

        // Beberapa record dengan status "Surat Selesai" untuk referensi
        Magang::create([
            'nama_peserta' => 'Irfan Maulana',
            'sekolah_asal' => 'STM Negeri Surabaya',
            'jurusan' => 'Teknik Instalasi Tenaga Listrik',
            'tanggal_mulai' => Carbon::now()->subDays(10),
            'tanggal_selesai' => Carbon::now()->addDays(20),
            'durasi_hari' => 30,
            'keperluan' => 'Program magang kurikulum sekolah',
            'status' => 'Surat Selesai',
            'phone' => '081999000111',
            'user_id' => 1,
        ]);

        Magang::create([
            'nama_peserta' => 'Yuni Aprilia',
            'sekolah_asal' => 'SMK Industri Gresik',
            'jurusan' => 'Teknik Mesin',
            'tanggal_mulai' => Carbon::now()->subDays(5),
            'tanggal_selesai' => Carbon::now()->addDays(25),
            'durasi_hari' => 30,
            'keperluan' => 'Program magang kurikulum sekolah',
            'status' => 'Surat Selesai',
            'phone' => '082000111222',
            'user_id' => 1,
        ]);
    }
}
