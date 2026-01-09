<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('surat', function (Blueprint $table) {
            $table->unsignedBigInteger('kop_surat_id')->nullable()->after('perihal');
            $table->string('generated_file_path')->nullable()->after('keterangan');
            $table->string('generated_file_url')->nullable()->after('generated_file_path');
            $table->string('generated_mime')->nullable()->after('generated_file_url');

            $table->foreign('kop_surat_id')->references('id')->on('kop_surats')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('surat', function (Blueprint $table) {
            $table->dropForeign(['kop_surat_id']);
            $table->dropColumn(['kop_surat_id','generated_file_path','generated_file_url','generated_mime']);
        });
    }
};