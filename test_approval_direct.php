<?php

/**
 * Test script untuk langsung test approval endpoint
 * Jalankan: php test_approval_direct.php
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Cuti;
use Illuminate\Support\Facades\Auth;

echo "=== Test Approval Direktur ===\n\n";

// 1. Cari user direktur
$direktur = User::where('role', 'direktur')->first();
if (!$direktur) {
    echo "❌ Tidak ada user dengan role direktur!\n";
    exit(1);
}

echo "✓ Direktur ditemukan: {$direktur->name} (ID: {$direktur->id})\n";

// 2. Cari pengajuan cuti yang pending
$cutiPending = Cuti::where('status', 'Pending')->first();
if (!$cutiPending) {
    echo "⚠️  Tidak ada pengajuan cuti dengan status Pending\n";
    
    // Buat dummy cuti untuk testing
    $karyawan = User::where('role', 'karyawan')->first();
    if (!$karyawan) {
        echo "❌ Tidak ada karyawan untuk membuat dummy cuti\n";
        exit(1);
    }
    
    $cutiPending = Cuti::create([
        'user_id' => $karyawan->id,
        'jenis' => 'Cuti Tahunan',
        'tanggal_mulai' => now()->addDays(1),
        'tanggal_selesai' => now()->addDays(3),
        'durasi_hari' => 2,
        'alasan' => 'Test approval',
        'status' => 'Pending',
        'pelimpahan_tugas' => 'Test',
    ]);
    
    echo "✓ Dummy cuti dibuat (ID: {$cutiPending->id})\n";
} else {
    echo "✓ Cuti pending ditemukan: ID {$cutiPending->id} dari {$cutiPending->user->name}\n";
}

// 3. Login sebagai direktur
Auth::login($direktur);
echo "✓ Login sebagai direktur berhasil\n";

// 4. Test approve
try {
    echo "\nMencoba approve cuti ID {$cutiPending->id}...\n";
    
    $cutiPending->status = 'Disetujui';
    $cutiPending->disetujui_oleh = $direktur->id;
    $cutiPending->tanggal_persetujuan = now();
    $cutiPending->save();
    
    echo "✅ Approval berhasil!\n";
    echo "   Status: {$cutiPending->status}\n";
    echo "   Disetujui oleh: {$cutiPending->disetujui_oleh}\n";
    echo "   Tanggal: {$cutiPending->tanggal_persetujuan}\n";
    
} catch (Exception $e) {
    echo "❌ Error saat approval: {$e->getMessage()}\n";
    echo "   {$e->getTraceAsString()}\n";
}

echo "\n=== Test selesai ===\n";
