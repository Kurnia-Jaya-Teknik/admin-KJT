<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cuti', function (Blueprint $table) {
            if (!Schema::hasColumn('cuti', 'file_surat')) {
                $table->string('file_surat')->nullable()->after('bukti');
            }
        });
    }

    public function down(): void
    {
        Schema::table('cuti', function (Blueprint $table) {
            if (Schema::hasColumn('cuti', 'file_surat')) {
                $table->dropColumn('file_surat');
            }
        });
    }
};
