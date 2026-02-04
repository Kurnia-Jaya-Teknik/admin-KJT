<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Clean data lama yang dilimpahkan ke diri sendiri
        $cutis = DB::table('cuti')->whereNotNull('dilimpahkan_ke')->get();
        
        foreach ($cutis as $cuti) {
            if (!empty($cuti->dilimpahkan_ke)) {
                $delegated = json_decode($cuti->dilimpahkan_ke, true);
                
                if (is_array($delegated)) {
                    // Remove user_id from delegated array
                    $cleaned = array_values(array_filter($delegated, function($id) use ($cuti) {
                        return intval($id) !== intval($cuti->user_id);
                    }));
                    
                    // Update if changed
                    if (count($cleaned) !== count($delegated)) {
                        DB::table('cuti')
                            ->where('id', $cuti->id)
                            ->update([
                                'dilimpahkan_ke' => empty($cleaned) ? null : json_encode($cleaned)
                            ]);
                    }
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse
    }
};
