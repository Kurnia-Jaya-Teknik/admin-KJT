<?php
// Test semua komponen
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Sistem Test ===\n\n";

// 1. Test database
echo "1. Database:\n";
$cutiCount = \App\Models\Cuti::count();
$cutiWithBukti = \App\Models\Cuti::whereNotNull('bukti')->count();
echo "   Total cuti: $cutiCount\n";
echo "   Cuti dengan bukti: $cutiWithBukti\n";

// 2. Test file storage
echo "\n2. File Storage:\n";
$testFile = 'cuti-bukti/test.txt';
$disk = \Illuminate\Support\Facades\Storage::disk('public');
echo "   File exists: " . ($disk->exists($testFile) ? "YES" : "NO") . "\n";
if ($disk->exists($testFile)) {
    $url = $disk->url($testFile);
    echo "   URL: $url\n";
}

// 3. Test symlink
echo "\n3. Symlink:\n";
$symlinkExists = file_exists(public_path('storage'));
echo "   public/storage exists: " . ($symlinkExists ? "YES" : "NO") . "\n";
if ($symlinkExists) {
    $target = readlink(public_path('storage'));
    echo "   Target: $target\n";
}

// 4. Test routes
echo "\n4. Routes:\n";
$routes = \Illuminate\Support\Facades\Route::getRoutes();
$found = false;
foreach ($routes as $route) {
    if (strpos($route->uri(), 'bukti') !== false || strpos($route->uri(), 'preview') !== false) {
        echo "   - {$route->methods()[0]} {$route->uri()}\n";
        $found = true;
    }
}
if (!$found) echo "   (no bukti/preview routes found)\n";

// 5. Test ApprovalController
echo "\n5. ApprovalController:\n";
$reflector = new \ReflectionClass(\App\Http\Controllers\ApprovalController::class);
$methods = $reflector->getMethods(\ReflectionMethod::IS_PUBLIC);
foreach ($methods as $method) {
    if ($method->name !== '__construct' && !str_starts_with($method->name, '__')) {
        echo "   - {$method->name}()\n";
    }
}

echo "\n✓ All checks complete\n";
?>
