<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Get a user untuk simulate auth
$user = \App\Models\User::first();
if (!$user) {
    echo "✗ No users found in database\n";
    exit(1);
}

echo "=== Route Test ===\n";
echo "Testing file download route with auth...\n\n";

// Simulate auth
\Illuminate\Support\Facades\Auth::loginUsingId($user->id);

// Test route generation
$filename = 'test.txt';
$route = route('bukti.download', $filename);
echo "Route generated: $route\n";

// Check if file exists
$path = storage_path('app/public/cuti-bukti/' . $filename);
echo "File path: $path\n";
echo "File exists: " . (file_exists($path) ? "YES\n" : "NO\n");

// Test HTTP access with curl
if (function_exists('curl_init')) {
    echo "\nTesting HTTP access:\n";
    $ch = curl_init($route);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_COOKIE, 'PHPSESSID=' . session_id());
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    echo "HTTP Status: $httpCode\n";
    echo "Response length: " . strlen($response) . " bytes\n";
    
    if ($httpCode == 200) {
        echo "✓ Route working! File accessible via HTTP\n";
    } else {
        echo "✗ Route returned $httpCode (expected 200)\n";
    }
}

// Test image file
echo "\n=== Image File Test ===\n";
$imageFilename = '7yLoWd2SfZbNrkuB6wbrLwPYDHuKP4Pi1r0NOukh.jpg';
$imagePath = storage_path('app/public/cuti-bukti/' . $imageFilename);
if (file_exists($imagePath)) {
    echo "✓ Image file exists: $imagePath\n";
    $imageRoute = route('bukti.download', $imageFilename);
    echo "Image route: $imageRoute\n";
} else {
    echo "✗ Image file not found\n";
}
?>
