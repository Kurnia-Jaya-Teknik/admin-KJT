<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('departemen_id')->nullable()->after('role')->constrained('departemen')->onDelete('set null');
            $table->enum('status_kontrak', ['PKWTT', 'PKWT', 'Magang'])->default('PKWTT')->after('departemen_id');
            $table->integer('sisa_cuti')->default(12)->after('status_kontrak');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['departemen_id']);
            $table->dropColumn(['departemen_id', 'status_kontrak', 'sisa_cuti']);
        });
    }
};
