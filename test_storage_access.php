<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$disk = \Illuminate\Support\Facades\Storage::disk('public');

echo "=== Storage Test ===\n";
echo "\n1. File exists: ";
$file = 'cuti-bukti/test.txt';
echo ($disk->exists($file) ? "✓ YES\n" : "✗ NO\n");

echo "\n2. URL generated: ";
$url = $disk->url($file);
echo "$url\n";

echo "\n3. Full path: ";
$path = $disk->path($file);
echo "$path\n";

echo "\n4. Path exists: ";
echo (file_exists($path) ? "✓ YES\n" : "✗ NO\n");

echo "\n5. Testing Apache access:\n";
$testUrl = 'http://localhost' . substr($url, strlen('http://localhost'));
echo "   URL: $testUrl\n";

// Try to access the file
$ch = curl_init($testUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "   HTTP Status: $httpCode\n";
if ($httpCode == 200) {
    echo "   ✓ File is accessible via web\n";
} else {
    echo "   ✗ File NOT accessible (Status: $httpCode)\n";
}

echo "\n6. Image file test:\n";
$imageFile = 'cuti-bukti/7yLoWd2SfZbNrkuB6wbrLwPYDHuKP4Pi1r0NOukh.jpg';
if ($disk->exists($imageFile)) {
    echo "   ✓ Image file exists\n";
    $imageUrl = $disk->url($imageFile);
    echo "   URL: $imageUrl\n";
} else {
    echo "   ✗ Image file NOT found\n";
}
?>
