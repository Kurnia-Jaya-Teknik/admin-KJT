<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE cuti MODIFY COLUMN jenis ENUM('Cuti Tahunan', 'Cuti Sakit', 'Cuti Darurat', 'Ijin Sakit') DEFAULT 'Cuti Tahunan'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE cuti MODIFY COLUMN jenis ENUM('Cuti Tahunan', 'Cuti Sakit', 'Cuti Darurat') DEFAULT 'Cuti Tahunan'");
    }
};
