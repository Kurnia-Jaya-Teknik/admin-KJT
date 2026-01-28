<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;
use App\Http\Controllers\DirekturController;

// Helper used by controller in web context
if (!function_exists('monthName')) {
    function monthName($m) {
        $months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        return $months[($m - 1) >= 0 ? ($m-1) : 0] ?? '';
    }
}

$req = Request::create('/direktur/laporan/cuti/pdf', 'GET', ['month'=>1,'year'=>2026,'period_by'=>'tanggal_mulai']);
$controller = new DirekturController();
$res = $controller->laporanCutiPdf($req);
file_put_contents('storage/app/public/tmp_laporan_cuti.pdf', $res->getContent());
echo "Wrote storage/app/public/tmp_laporan_cuti.pdf\n";
