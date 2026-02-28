<?php
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Cuti;
use Illuminate\Support\Facades\DB;

echo "🔍 CEK STATUS SEMUA CUTI DI DATABASE:\n";
echo "═══════════════════════════════════════════════════════════════\n\n";

$allCuti = Cuti::with('user')->orderByDesc('id')->get();

foreach ($allCuti as $cuti) {
    echo "📋 Cuti #{$cuti->id}\n";
    echo "   Karyawan       : {$cuti->user->name}\n";
    echo "   Jenis          : {$cuti->jenis}\n";
    echo "   Status         : {$cuti->status}\n";
    echo "   File Surat     : " . ($cuti->file_surat ?? 'TIDAK ADA') . "\n";
    echo "   Disetujui Oleh : " . ($cuti->disetujui_oleh ? 'User #' . $cuti->disetujui_oleh : 'BELUM') . "\n";
    echo "───────────────────────────────────────────────────────────────\n\n";
}

echo "\n📊 SUMMARY:\n";
$summary = Cuti::select('status', DB::raw('count(*) as total'))->groupBy('status')->get();
foreach ($summary as $row) {
    echo "   {$row->status}: {$row->total} data\n";
}
