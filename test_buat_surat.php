<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    echo "=== Testing Buat Surat Logic ===" . PHP_EOL;
    
    $cutiId = 3;
    $cuti = \App\Models\Cuti::findOrFail($cutiId);
    
    echo "Cuti ID: " . $cuti->id . PHP_EOL;
    echo "Status: " . $cuti->status . PHP_EOL;
    echo "User: " . ($cuti->user ? $cuti->user->name : "NULL") . PHP_EOL;
    
    if ($cuti->status !== 'Disetujui') {
        echo "ERROR: Status not approved" . PHP_EOL;
        exit(1);
    }
    
    $karyawan = $cuti->user;
    if (!$karyawan) {
        echo "ERROR: Karyawan not found" . PHP_EOL;
        exit(1);
    }
    
    echo "Trying to render template..." . PHP_EOL;
    $html = view('surat.cuti', [
        'karyawan' => $karyawan,
        'cuti' => $cuti,
    ])->render();
    
    echo "Template rendered successfully, HTML length: " . strlen($html) . PHP_EOL;
    
    echo "Trying to create Dompdf..." . PHP_EOL;
    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    echo "PDF rendered successfully" . PHP_EOL;
    
    $out = $dompdf->output();
    echo "PDF output size: " . strlen($out) . " bytes" . PHP_EOL;
    
    echo "SUCCESS!" . PHP_EOL;
    
} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . PHP_EOL;
    echo "Stack: " . $e->getTraceAsString() . PHP_EOL;
}
