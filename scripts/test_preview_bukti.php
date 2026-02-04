<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Http\Controllers\ApprovalController;
use Illuminate\Http\Request;

// login as a director user for permission check
$director = \App\Models\User::where('role','direktur')->first();
if (! $director) { echo "No director user found\n"; exit(1); }
\Illuminate\Support\Facades\Auth::loginUsingId($director->id);

$ctrl = new ApprovalController();
$response = $ctrl->preview(new Request(), 'cuti', 1);
$body = $response->getContent();
file_put_contents('storage/app/preview_out.html', $body);
echo "Wrote preview to storage/app/preview_out.html\n";