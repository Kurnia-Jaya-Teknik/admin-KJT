<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Alur:
     * 1. Direktur buat permintaan surat (input nomor_surat & tanggal_surat_diminta)
     * 2. Admin menerima notif
     * 3. Admin lihat form dengan nomor & tanggal yang sudah di-fill
     * 4. Admin input nomor_surat_dibuat & tanggal_surat_dibuat (bisa berbeda dari yang diminta)
     * 5. Admin klik preview/generate surat
     */
    public function up(): void
    {
        Schema::table('magangs', function (Blueprint $table) {
            // Diminta dari Direktur
            $table->string('nomor_surat_diminta')->nullable()->after('status')->comment('Nomor surat yang diminta direktur');
            $table->date('tanggal_surat_diminta')->nullable()->after('nomor_surat_diminta')->comment('Tanggal surat yang diminta direktur');
            
            // Dibuat oleh Admin (bisa berbeda dari yang diminta)
            $table->string('nomor_surat_dibuat')->nullable()->after('tanggal_surat_diminta')->comment('Nomor surat yang dibuat admin');
            $table->date('tanggal_surat_dibuat')->nullable()->after('nomor_surat_dibuat')->comment('Tanggal surat yang dibuat admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('magangs', function (Blueprint $table) {
            $table->dropColumn([
                'nomor_surat_diminta',
                'tanggal_surat_diminta',
                'nomor_surat_dibuat',
                'tanggal_surat_dibuat',
            ]);
        });
    }
};
