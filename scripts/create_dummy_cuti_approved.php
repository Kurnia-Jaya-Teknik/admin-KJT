<?php
/**
 * Script untuk membuat dummy data cuti yang sudah disetujui
 * dan sudah memiliki file surat untuk testing preview
 */
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Cuti;
use App\Models\User;
use Carbon\Carbon;

try {
    echo "🔄 Membuat dummy data cuti untuk testing...\n\n";

    // Get karyawan users
    $karyawanUsers = User::where('role', 'karyawan')->get();

    if ($karyawanUsers->isEmpty()) {
        echo "❌ Tidak ada karyawan di database. Buat karyawan terlebih dahulu.\n";
        exit(1);
    }

    $cutiTypes = ['Cuti Tahunan', 'Cuti Sakit', 'Cuti Khusus'];
    $createdApproved = 0;
    $createdPending = 0;

    // ==================== APPROVED CUTI ====================
    echo "📌 MEMBUAT CUTI YANG SUDAH DISETUJUI (dengan file_surat):\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

    $approvedUsers = $karyawanUsers->take(3);
    foreach ($approvedUsers as $index => $user) {
        $type = $cutiTypes[$index % count($cutiTypes)];
        $duration = rand(3, 10);
        $startDate = Carbon::now()->addDays(rand(5, 15));
        $endDate = $startDate->copy()->addDays($duration - 1);

        $cuti = Cuti::create([
            'user_id' => $user->id,
            'jenis' => $type,
            'durasi' => $duration,
            'durasi_hari' => $duration,
            'tanggal_mulai' => $startDate,
            'tanggal_selesai' => $endDate,
            'alasan' => "Alasan cuti $type untuk testing preview surat.",
            'status' => 'Disetujui',
            'disetujui_oleh' => 1, // Admin or Direktur
            'tanggal_persetujuan' => Carbon::now()->subDays(2),
            'delegated_users' => null,
            'bukti' => null,
            'file_surat' => 'cuti/dummy_' . uniqid() . '.pdf', // Dummy file path (untuk testing preview)
        ]);

        echo "✅ APPROVED: Cuti #{$cuti->id}\n";
        echo "   Karyawan  : {$user->name}\n";
        echo "   Jenis     : {$type}\n";
        echo "   Periode   : {$startDate->format('d/m/Y')} - {$endDate->format('d/m/Y')}\n";
        echo "   Durasi    : {$duration} hari\n";
        echo "   File      : {$cuti->file_surat}\n\n";

        $createdApproved++;
    }

    // ==================== PENDING CUTI ====================
    echo "\n📌 MEMBUAT CUTI YANG MASIH PENDING (tanpa file_surat):\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

    $pendingUsers = $karyawanUsers->slice(3, 2);
    foreach ($pendingUsers as $index => $user) {
        $type = $cutiTypes[rand(0, count($cutiTypes) - 1)];
        $duration = rand(2, 5);
        $startDate = Carbon::now()->addDays(rand(20, 30));
        $endDate = $startDate->copy()->addDays($duration - 1);

        $cuti = Cuti::create([
            'user_id' => $user->id,
            'jenis' => $type,
            'durasi' => $duration,
            'durasi_hari' => $duration,
            'tanggal_mulai' => $startDate,
            'tanggal_selesai' => $endDate,
            'alasan' => "Pengajuan cuti $type untuk testing flow.",
            'status' => 'Pending',
            'disetujui_oleh' => null,
            'tanggal_persetujuan' => null,
            'delegated_users' => null,
            'bukti' => null,
            'file_surat' => null, // Belum ada file
        ]);

        echo "⏳ PENDING: Cuti #{$cuti->id}\n";
        echo "   Karyawan  : {$user->name}\n";
        echo "   Jenis     : {$type}\n";
        echo "   Periode   : {$startDate->format('d/m/Y')} - {$endDate->format('d/m/Y')}\n";
        echo "   Durasi    : {$duration} hari\n";
        echo "   Status    : Menunggu Persetujuan Direktur\n\n";

        $createdPending++;
    }

    echo "✨ SELESAI!\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "✅ Cuti Disetujui  : {$createdApproved} data\n";
    echo "⏳ Cuti Pending    : {$createdPending} data\n";
    echo "📝 Total           : " . ($createdApproved + $createdPending) . " data\n\n";

    echo "🎯 NEXT STEPS:\n";
    echo "1. Masuk ke halaman admin/cuti\n";
    echo "2. Tab 'Pengajuan Cuti (Pending)' - lihat cuti yang masih pending\n";
    echo "3. Tab 'Surat yang Dibuat' - lihat cuti yang sudah disetujui dengan file_surat\n";
    echo "4. Klik 'Lihat' untuk membuka detail dan preview surat\n";
    echo "5. Klik 'Buat Surat' untuk generate PDF beneran dengan logo yang benar\n\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
