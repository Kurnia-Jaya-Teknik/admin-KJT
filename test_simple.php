<?php
// Simple test
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$filename = 'test.txt';
$route = route('bukti.download', $filename);
echo "Testing: $route\n";

// Direct file test
$path = storage_path('app/public/cuti-bukti/' . $filename);
echo "File: $path\n";
echo "Exists: " . (file_exists($path) ? "YES\n" : "NO\n");

// Try curl
$ch = curl_init($route);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 3);
curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "HTTP Status: $code\n";
echo ($code == 200 ? "✓ OK" : "✗ FAILED");
?>
