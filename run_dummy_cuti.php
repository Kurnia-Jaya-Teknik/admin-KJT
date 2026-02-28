<?php
/**
 * Script untuk membuat dummy data cuti
 * Jalankan: php run_dummy_cuti.php
 */
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
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

    if ($karyawanUsers->count() < 3) {
        echo "⚠️  Hanya ada " . $karyawanUsers->count() . " karyawan. Perlu minimal 3 untuk demo lengkap.\n";
    }

    $cutiTypes = ['Cuti Tahunan', 'Cuti Sakit', 'Cuti Darurat', 'Ijin Sakit'];
    $created = 0;

    // ==================== TAB 1: PENGAJUAN CUTI ====================
    echo "📌 TAB 1: PENGAJUAN CUTI (menunggu atau siap dibuat surat):\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

    // Scenario 1: Status Pending (menunggu approval direktur)
    // - Modal detail hanya info, TIDAK ada button "Buat Surat"
    if ($karyawanUsers->count() >= 1) {
        $user = $karyawanUsers->first();
        $type = $cutiTypes[0];
        $duration = 5;
        $startDate = Carbon::now()->addDays(10);
        $endDate = $startDate->copy()->addDays($duration - 1);

        $cuti = Cuti::create([
            'user_id' => $user->id,
            'jenis' => $type,
            'durasi' => $duration,
            'durasi_hari' => $duration,
            'tanggal_mulai' => $startDate,
            'tanggal_selesai' => $endDate,
            'alasan' => "Pengajuan $type, masih menunggu persetujuan direktur.",
            'status' => 'Pending',
            'disetujui_oleh' => null,
            'tanggal_persetujuan' => null,
            'delegated_users' => null,
            'bukti' => null,
            'file_surat' => null,
        ]);

        echo "⏳ MENUNGGU PERSETUJUAN: Cuti #{$cuti->id}\n";
        echo "   Karyawan  : {$user->name}\n";
        echo "   Jenis     : {$type}\n";
        echo "   Periode   : {$startDate->format('d/m/Y')} - {$endDate->format('d/m/Y')}\n";
        echo "   Status    : Pending (Menunggu Direktur)\n";
        echo "   Di Modal  : Hanya INFO, TIDAK ada button 'Buat Surat'\n\n";

        $created++;
    }

    // Scenario 2: Status Disetujui tapi BELUM ada file_surat
    // - Modal detail ADA button "Buat Surat" → form input → generate PDF
    if ($karyawanUsers->count() >= 2) {
        $user = $karyawanUsers[1];
        $type = $cutiTypes[1];
        $duration = 3;
        $startDate = Carbon::now()->addDays(15);
        $endDate = $startDate->copy()->addDays($duration - 1);

        $cuti = Cuti::create([
            'user_id' => $user->id,
            'jenis' => $type,
            'durasi' => $duration,
            'durasi_hari' => $duration,
            'tanggal_mulai' => $startDate,
            'tanggal_selesai' => $endDate,
            'alasan' => "Pengajuan $type sudah disetujui direktur, siap dibuat surat.",
            'status' => 'Disetujui',
            'disetujui_oleh' => 1,
            'tanggal_persetujuan' => Carbon::now()->subDays(1),
            'delegated_users' => null,
            'bukti' => null,
            'file_surat' => null, // ⭐ PENTING: belum ada file
        ]);

        echo "✅ SIAP DIBUAT SURAT: Cuti #{$cuti->id}\n";
        echo "   Karyawan  : {$user->name}\n";
        echo "   Jenis     : {$type}\n";
        echo "   Periode   : {$startDate->format('d/m/Y')} - {$endDate->format('d/m/Y')}\n";
        echo "   Status    : Disetujui (Tanggal: " . Carbon::now()->subDays(1)->format('d/m/Y') . ")\n";
        echo "   Di Modal  : ADA button 'Buat Surat' ⭐\n";
        echo "             - Klik tombol → form input → generate PDF\n\n";

        $created++;
    }

    // ==================== TAB 2: SURAT YANG DIBUAT ====================
    echo "\n📌 TAB 2: SURAT YANG DIBUAT (sudah ada file_surat):\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

    // Scenario 3: Status Disetujui & sudah ada file_surat
    // - Tombol di Tab 2: "Lihat" (preview PDF) & "Download"
    if ($karyawanUsers->count() >= 3) {
        $user = $karyawanUsers[2];
        $type = $cutiTypes[2];
        $duration = 4;
        $startDate = Carbon::now()->addDays(20);
        $endDate = $startDate->copy()->addDays($duration - 1);

        $cuti = Cuti::create([
            'user_id' => $user->id,
            'jenis' => $type,
            'durasi' => $duration,
            'durasi_hari' => $duration,
            'tanggal_mulai' => $startDate,
            'tanggal_selesai' => $endDate,
            'alasan' => "Pengajuan $type sudah disetujui dengan surat dibuat.",
            'status' => 'Disetujui',
            'disetujui_oleh' => 1,
            'tanggal_persetujuan' => Carbon::now()->subDays(3),
            'delegated_users' => null,
            'bukti' => null,
            'file_surat' => 'cuti/demo_' . uniqid() . '.pdf', // ⭐ Ada file surat
        ]);

        echo "📄 SURAT SUDAH DIBUAT: Cuti #{$cuti->id}\n";
        echo "   Karyawan  : {$user->name}\n";
        echo "   Jenis     : {$type}\n";
        echo "   Periode   : {$startDate->format('d/m/Y')} - {$endDate->format('d/m/Y')}\n";
        echo "   Status    : Disetujui (Tanggal: " . Carbon::now()->subDays(3)->format('d/m/Y') . ")\n";
        echo "   File      : {$cuti->file_surat} ✅\n";
        echo "   Tombol    : 'Lihat' (preview) & 'Download'\n\n";

        $created++;
    }

    echo "\n✨ SELESAI!\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "📝 Created: {$created} demo cuti record\n\n";

    echo "🎯 FLOW UNTUK TESTING:\n";
    echo "─────────────────────────────────────────────────────\n";
    echo "TAB 1: PENGAJUAN CUTI\n";
    echo "  1️⃣  Cuti PENDING (Cuti #?)\n";
    echo "      - Klik 'Lihat' → modal detail\n";
    echo "      - Lihat info saja → TIDAK ADA button 'Buat Surat'\n";
    echo "      - Klik 'Tutup'\n\n";
    echo "  2️⃣  Cuti DISETUJUI BELUM FILE (Cuti #?)\n";
    echo "      - Klik 'Lihat' → modal detail\n";
    echo "      - ADA button 'Buat Surat' ⭐\n";
    echo "      - Klik 'Buat Surat' → form input (nomor surat, dll)\n";
    echo "      - Submit → PDF dibuat dengan logo benar\n";
    echo "      - Surat pindah ke TAB 2\n\n";
    echo "TAB 2: SURAT YANG DIBUAT\n";
    echo "  1️⃣  Cuti dengan FILE (hasil dari TAB 1 atau yang sudah ada)\n";
    echo "      - Klik 'Lihat' → preview PDF dengan logo\n";
    echo "      - Klik 'Download' → download PDF\n";
    echo "─────────────────────────────────────────────────────\n\n";

} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
