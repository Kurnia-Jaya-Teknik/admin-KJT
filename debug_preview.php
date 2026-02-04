<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

\Illuminate\Support\Facades\Auth::loginUsingId(\App\Models\User::first()->id);

try {
    $controller = new \App\Http\Controllers\ApprovalController();
    $request = \Illuminate\Http\Request::create('/api/cuti/1/preview', 'GET');
    $request->setUserResolver(function () {
        return \Illuminate\Support\Facades\Auth::user();
    });
    
    $response = $controller->preview($request, 'cuti', 1);
    echo "Response: " . $response->getContent() . "\n";
} catch (\Throwable $e) {
    echo "Error: {$e->getMessage()}\n";
    echo "File: {$e->getFile()}:{$e->getLine()}\n";
    echo "Trace: {$e->getTraceAsString()}\n";
}
?>
