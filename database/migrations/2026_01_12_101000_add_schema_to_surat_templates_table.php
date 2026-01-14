<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('surat_templates', function (Blueprint $table) {
            $table->json('schema')->nullable()->after('content');
        });
    }

    public function down()
    {
        Schema::table('surat_templates', function (Blueprint $table) {
            $table->dropColumn('schema');
        });
    }
};