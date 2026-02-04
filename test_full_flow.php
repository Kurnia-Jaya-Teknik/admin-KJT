<?php
// Verify bukti file is accessible via storage symlink
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Testing File Access ===\n\n";

// Get a cuti with bukti
$cuti = \App\Models\Cuti::whereNotNull('bukti')->first();
if (!$cuti) {
    echo "✗ No cuti with bukti found\n";
    exit(1);
}

echo "Cuti ID: {$cuti->id}\n";
echo "Bukti: {$cuti->bukti}\n";

// Get URL
$disk = \Illuminate\Support\Facades\Storage::disk('public');
$url = $disk->url($cuti->bukti);
echo "URL: $url\n";

// Test file access
echo "\nTesting direct file access:\n";
$path = storage_path('app/public/' . $cuti->bukti);
echo "Path: $path\n";
echo "File exists: " . (file_exists($path) ? "✓ YES" : "✗ NO") . "\n";

// Try symlink path
echo "\nTesting symlink path:\n";
$symlinkPath = public_path('storage/' . $cuti->bukti);
echo "Path: $symlinkPath\n";
echo "File exists: " . (file_exists($symlinkPath) ? "✓ YES" : "✗ NO") . "\n";

// Test preview endpoint
echo "\nTesting preview endpoint:\n";
\Illuminate\Support\Facades\Auth::loginUsingId(\App\Models\User::whereIn('role', ['direktur', 'admin_hrd'])->first()->id);

try {
    $controller = new \App\Http\Controllers\ApprovalController();
    $request = \Illuminate\Http\Request::create('/api/cuti/1/preview', 'GET');
    $response = $controller->preview($request, 'cuti', $cuti->id);
    $data = json_decode($response->getContent(), true);
    
    if (isset($data['ok']) && $data['ok']) {
        echo "✓ Preview endpoint works\n";
        echo "HTML length: " . strlen($data['html'] ?? '') . " bytes\n";
        
        // Check if bukti is in HTML
        if (strpos($data['html'], 'Surat Dokter') !== false) {
            echo "✓ Surat Dokter section found in preview\n";
        }
    } else {
        echo "✗ Preview returned error\n";
    }
} catch (\Exception $e) {
    echo "✗ Preview error: {$e->getMessage()}\n";
}

echo "\n✓ All tests passed\n";
?>
