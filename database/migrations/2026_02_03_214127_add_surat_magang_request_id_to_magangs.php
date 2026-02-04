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
        Schema::table('magangs', function (Blueprint $table) {
            $table->unsignedBigInteger('surat_magang_request_id')->nullable()->after('id')->comment('Link ke SuratMagangRequest');
            $table->foreign('surat_magang_request_id')->references('id')->on('surat_magang_requests')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('magangs', function (Blueprint $table) {
            $table->dropForeign(['surat_magang_request_id']);
            $table->dropColumn('surat_magang_request_id');
        });
    }
};
