<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Magang;
use Dompdf\Dompdf;

// Ambil magang dengan nomor surat
$magang = Magang::where('nomor_surat_diminta', '001/HRD/2026')->first();

if (!$magang) {
    echo "❌ Magang tidak ditemukan\n";
    exit(1);
}

echo "✓ Magang found: " . $magang->nama_peserta . PHP_EOL;

// Ambil semua magang dari sekolah yang sama
$magangList = Magang::where('sekolah_asal', $magang->sekolah_asal)
    ->where('status', 'Permintaan Surat')
    ->orderBy('created_at', 'asc')
    ->get();

echo "✓ Magang List count: " . $magangList->count() . PHP_EOL;

// Test render view
try {
    $html = view('surat.magang', [
        'magangList' => $magangList,
        'logoPath' => public_path('img/image.png'),
        'nomor_surat' => '001/HRD/2026',
        'tanggal_surat' => '2026-02-03',
    ])->render();
    
    echo "✓ View rendered, HTML length: " . strlen($html) . " bytes\n";
    
    // Test PDF generation
    $dompdf = new Dompdf([
        'chroot' => public_path(),
        'isHtml5ParserEnabled' => true,
    ]);
    
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    $pdfContent = $dompdf->output();
    echo "✓ PDF generated, size: " . strlen($pdfContent) . " bytes\n";
    
    $pdfBase64 = base64_encode($pdfContent);
    echo "✓ PDF Base64 encoded, size: " . strlen($pdfBase64) . " bytes\n";
    
    // Test if it can be decoded back
    $decoded = base64_decode($pdfBase64);
    echo "✓ PDF Base64 decoded, size: " . strlen($decoded) . " bytes\n";
    
    if (strlen($decoded) === strlen($pdfContent)) {
        echo "✅ SUCCESS! PDF dapat di-generate dan di-encode dengan benar!\n";
    }
    
} catch (\Throwable $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
}
