<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Testing storage route...\n\n";

// Test file
$testFile = 'cuti-bukti/7yLoWd2SfZbNrkuB6wbrLwPYDHuKP4Pi1r0NOukh.jpg';
$url = url('/storage/' . $testFile);

echo "URL: $url\n";

// Test dengan curl
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_NOBODY, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 3);

curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
curl_close($ch);

echo "HTTP Status: $httpCode\n";
echo "Content-Type: $contentType\n";

if ($httpCode == 200) {
    echo "\n✓ SUCCESS! File accessible via route\n";
} else {
    echo "\n✗ FAILED with status $httpCode\n";
}
?>
