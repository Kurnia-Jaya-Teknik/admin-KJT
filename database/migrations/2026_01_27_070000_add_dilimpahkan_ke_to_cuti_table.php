<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('cuti', function (Blueprint $table) {
            $table->json('dilimpahkan_ke')->nullable()->after('alasan');
        });
    }

    public function down()
    {
        Schema::table('cuti', function (Blueprint $table) {
            $table->dropColumn('dilimpahkan_ke');
        });
    }
};