<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('jenis', ['Surat Rekomendasi', 'Surat Keterangan', 'Surat Tanggung Jawab', 'Surat Lainnya'])->default('Surat Keterangan');
            $table->string('nomor_surat')->unique();
            $table->string('perihal');
            $table->text('isi_surat');
            $table->date('tanggal_surat');
            $table->enum('status', ['Draft', 'Menunggu Persetujuan', 'Disetujui', 'Ditolak', 'Diterbitkan'])->default('Draft');
            $table->foreignId('dibuat_oleh')->constrained('users')->onDelete('cascade');
            $table->foreignId('disetujui_oleh')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('tanggal_persetujuan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};
