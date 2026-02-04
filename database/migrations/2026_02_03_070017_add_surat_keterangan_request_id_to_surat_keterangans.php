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
            $table->foreignId('surat_keterangan_request_id')->nullable()->constrained('surat_keterangan_requests')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_keterangans', function (Blueprint $table) {
            $table->dropForeign(['surat_keterangan_request_id']);
            $table->dropColumn('surat_keterangan_request_id');
        });
    }
};
