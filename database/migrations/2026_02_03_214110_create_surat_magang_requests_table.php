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
        Schema::create('surat_magang_requests', function (Blueprint $table) {
            $table->id();
            $table->string('sekolah_asal')->comment('Sekolah asal siswa magang');
            $table->integer('jumlah_siswa')->default(1)->comment('Jumlah siswa dalam satu permintaan');
            $table->text('keterangan')->nullable()->comment('Keterangan tambahan');
            $table->string('status')->default('Pending')->comment('Pending, Approved, Rejected, Completed');
            $table->timestamp('tanggal_diminta')->useCurrent()->comment('Tanggal permintaan dibuat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_magang_requests');
    }
};
