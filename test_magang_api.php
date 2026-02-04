#!/usr/bin/env php
<?php
// Simulasi request API untuk test response

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Magang;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\MagangController;

// Buat request
$request = new Request();
$request->setMethod('POST');
$request->request->add([
    'nomor_surat_dibuat' => '001/HRD/2026',
    'tanggal_surat_dibuat' => '2026-02-03',
]);

// Ambil magang ID
$magang = Magang::where('nomor_surat_diminta', '001/HRD/2026')->first();
if (!$magang) {
    echo "❌ Magang tidak ditemukan\n";
    exit(1);
}

echo "Testing MagangController::storeMagangSurat()\n";
echo "Magang ID: " . $magang->id . "\n";
echo "Peserta: " . $magang->nama_peserta . "\n\n";

// Call controller method
$controller = new MagangController();

// Manually set user untuk auth check
\Illuminate\Support\Facades\Auth::guard('web')->setUser(
    \App\Models\User::whereRole('admin_hrd')->first() ?? \App\Models\User::first()
);

$response = $controller->storeMagangSurat($request, $magang->id);

// Get response content
$content = $response->getContent();
$data = json_decode($content, true);

echo "Response Status: " . $response->getStatusCode() . "\n";
echo "Response OK: " . ($data['ok'] ? 'true' : 'false') . "\n";
echo "Has pdfBase64: " . (isset($data['pdfBase64']) ? 'YES' : 'NO') . "\n";

if (isset($data['pdfBase64'])) {
    echo "PDF Base64 length: " . strlen($data['pdfBase64']) . " chars\n";
} else {
    echo "❌ pdfBase64 tidak ada di response!\n";
}

if (isset($data['fileName'])) {
    echo "File Name: " . $data['fileName'] . "\n";
}

if (isset($data['url'])) {
    echo "URL: " . $data['url'] . "\n";
}

echo "\n✅ Test selesai!\n";
