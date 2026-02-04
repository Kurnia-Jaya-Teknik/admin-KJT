<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_keterangans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('Karyawan yang menerima surat');
            $table->string('nomor_surat')->unique()->comment('Nomor surat keterangan kerja');
            $table->date('tanggal_surat')->comment('Tanggal pembuatan surat');
            $table->string('jabatan')->comment('Jabatan karyawan');
            $table->string('unit_kerja')->comment('Unit kerja/departemen');
            $table->date('tanggal_mulai_kerja')->comment('Tanggal mulai bekerja');
            $table->date('tanggal_selesai_kerja')->nullable()->comment('Tanggal selesai bekerja (jika sudah resign)');
            $table->text('keterangan')->nullable()->comment('Isi keterangan tambahan');
            $table->string('file_surat')->nullable()->comment('Path ke file PDF surat');
            $table->enum('status', ['Draft', 'Selesai', 'Ditandatangani'])->default('Draft')->comment('Status surat');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('tanggal_surat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keterangans');
    }
};
