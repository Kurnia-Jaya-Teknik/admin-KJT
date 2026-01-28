<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // For MySQL, modify the enum column to include new values
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE surat MODIFY COLUMN jenis ENUM('Surat Rekomendasi', 'Surat Keterangan', 'Surat Tanggung Jawab', 'Surat Lainnya', 'Cuti', 'Lembur') DEFAULT 'Surat Keterangan'");
        }
        
        // For SQLite or other databases that don't support direct enum modification
        // This would require a more complex migration, but typically not needed for dev
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE surat MODIFY COLUMN jenis ENUM('Surat Rekomendasi', 'Surat Keterangan', 'Surat Tanggung Jawab', 'Surat Lainnya') DEFAULT 'Surat Keterangan'");
        }
    }
};
