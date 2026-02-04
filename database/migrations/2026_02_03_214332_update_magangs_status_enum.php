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
        // Keep the status enum with all possible values
        // No need to modify since the table already has the needed values
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op since we didn't modify the table
    }
};
