<?php
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Employee\LemburController;

$req = Request::create('/karyawan/api/lembur', 'GET');
// simulate authenticated user id 5
$req->setUserResolver(function() { return App\Models\User::find(5); });

$controller = new LemburController();
$response = $controller->index($req);

echo "Status: " . $response->getStatusCode() . "\n";
echo "Content:\n" . $response->getContent() . "\n";