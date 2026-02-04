<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $divs = [
            ['kode' => 'mekanik', 'nama' => 'Mekanik', 'deskripsi' => 'Divisi Mekanik'],
            ['kode' => 'elektrik', 'nama' => 'Elektrik', 'deskripsi' => 'Divisi Elektrik'],
            ['kode' => 'cleaning', 'nama' => 'Cleaning', 'deskripsi' => 'Divisi Cleaning'],
        ];

        foreach ($divs as $d) {
            DB::table('departemen')->updateOrInsert(
                ['kode' => $d['kode']],
                ['nama' => $d['nama'], 'deskripsi' => $d['deskripsi'], 'updated_at' => now(), 'created_at' => now()]
            );
        }
    }

    public function down(): void
    {
        DB::table('departemen')->whereIn('kode', ['mekanik','elektrik','cleaning'])->delete();
    }
};