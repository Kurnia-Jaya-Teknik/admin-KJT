<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$filename = '7yLoWd2SfZbNrkuB6wbrLwPYDHuKP4Pi1r0NOukh.jpg';
$url = route('files.bukti', $filename);

echo "Generated URL: $url\n";

// Test with curl
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_NOBODY, true);
curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Status: $code\n";
echo ($code == 200 ? "✓ SUCCESS!" : "✗ FAILED!");
?>
