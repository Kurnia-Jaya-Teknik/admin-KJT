<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request as HttpRequest;
use App\Http\Controllers\Api\Employee\RequestController;
use App\Models\User;

$user = User::where('email', 'karyawan@test.com')->first();
if (! $user) {
    echo "User not found\n";
    exit(1);
}

// create a request and set user resolver
$req = HttpRequest::create('/api/employee/requests', 'GET', ['page' => 1]);
$req->setUserResolver(function() use ($user) { return $user; });

$controller = new RequestController();
$response = $controller->index($req);

// response is a JsonResponse; print decoded content
$content = $response->getContent();
echo $content . PHP_EOL;
