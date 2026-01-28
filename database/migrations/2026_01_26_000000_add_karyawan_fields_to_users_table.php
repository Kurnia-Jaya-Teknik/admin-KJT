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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nik')->nullable()->unique()->after('email');
            $table->string('jabatan')->nullable()->after('nik');
            $table->string('phone')->nullable()->after('jabatan');
            $table->text('alamat')->nullable()->after('phone');
            $table->enum('status', ['aktif', 'cuti', 'nonaktif'])->default('aktif')->after('alamat');
            $table->date('tanggal_bergabung')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nik', 'jabatan', 'phone', 'alamat', 'status', 'tanggal_bergabung']);
        });
    }
};
