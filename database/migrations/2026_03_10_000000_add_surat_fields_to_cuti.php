<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cuti', function (Blueprint $table) {
            // Add new status values if they don't exist
            // Status enum will be: Pending, Disetujui, Ditolak, Surat Dibuat, Surat Terkirim
            
            if (!Schema::hasColumn('cuti', 'pembuat_surat_id')) {
                $table->unsignedBigInteger('pembuat_surat_id')->nullable();
            }
            if (!Schema::hasColumn('cuti', 'tanggal_surat_dibuat')) {
                $table->timestamp('tanggal_surat_dibuat')->nullable();
            }
            if (!Schema::hasColumn('cuti', 'nomor_surat')) {
                $table->string('nomor_surat')->nullable()->unique();
            }
            if (!Schema::hasColumn('cuti', 'tahap_persetujuan')) {
                $table->enum('tahap_persetujuan', ['Menunggu Direktur', 'Disetujui Direktur', 'Surat Dibuat', 'Surat Terkirim'])->default('Menunggu Direktur');
            }
        });
    }

    public function down(): void
    {
        Schema::table('cuti', function (Blueprint $table) {
            if (Schema::hasColumn('cuti', 'tahap_persetujuan')) {
                $table->dropColumn('tahap_persetujuan');
            }
            if (Schema::hasColumn('cuti', 'nomor_surat')) {
                $table->dropColumn('nomor_surat');
            }
            if (Schema::hasColumn('cuti', 'tanggal_surat_dibuat')) {
                $table->dropColumn('tanggal_surat_dibuat');
            }
            if (Schema::hasColumn('cuti', 'pembuat_surat_id')) {
                $table->dropColumn('pembuat_surat_id');
            }
        });
    }
};

