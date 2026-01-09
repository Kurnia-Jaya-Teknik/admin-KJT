<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kop_surats', function (Blueprint $table) {
            $table->boolean('is_template')->default(false)->after('mime');
            $table->json('placeholders')->nullable()->after('is_template');
        });
    }

    public function down()
    {
        Schema::table('kop_surats', function (Blueprint $table) {
            $table->dropColumn(['is_template','placeholders']);
        });
    }
};