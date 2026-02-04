<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surat', function (Blueprint $table) {
            $table->string('referensi_type')->nullable()->after('keterangan');
            $table->unsignedBigInteger('referensi_id')->nullable()->after('referensi_type');
            $table->foreignId('dikirim_oleh')->nullable()->constrained('users')->onDelete('set null')->after('disetujui_oleh');
            $table->timestamp('dikirim_at')->nullable()->after('dikirim_oleh');
        });

        // NOTE: If you prefer a "Menunggu Pengiriman" status separate from existing statuses,
        // you could alter the enum here. For now we will use existing 'Disetujui' status to indicate ready-to-send.
    }

    public function down(): void
    {
        Schema::table('surat', function (Blueprint $table) {
            $table->dropColumn(['referensi_type','referensi_id','dikirim_oleh','dikirim_at']);
        });
    }
};
