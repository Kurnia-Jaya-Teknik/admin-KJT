<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ReportsController;

$req = Request::create('/api/reports/cuti', 'GET', ['month'=>1, 'year'=>2026, 'period_by'=>'tanggal_mulai']);
$controller = new ReportsController();
$res = $controller->cuti($req);

// Response is JsonResponse
$content = $res->getContent();
echo $content . PHP_EOL;
