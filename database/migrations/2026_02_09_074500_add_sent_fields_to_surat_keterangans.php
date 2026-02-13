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
        Schema::table('surat_keterangans', function (Blueprint $table) {
            $table->boolean('is_sent')->default(false)->comment('Apakah surat sudah dikirim ke karyawan');
            $table->dateTime('sent_at')->nullable()->comment('Waktu surat dikirim');
            $table->text('sent_notes')->nullable()->comment('Catatan pengiriman');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_keterangans', function (Blueprint $table) {
            $table->dropColumn(['is_sent', 'sent_at', 'sent_notes']);
        });
    }
};
