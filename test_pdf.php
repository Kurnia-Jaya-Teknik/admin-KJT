<?php
// Test PDF generation directly
require 'vendor/autoload.php';
$app = require_once('bootstrap/app.php');
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Cuti;

try {
    $cuti = Cuti::where('status', 'Disetujui')->first();
    if (!$cuti) {
        echo "No approved cuti found";
        exit;
    }
    
    echo "Testing PDF generation for Cuti ID: " . $cuti->id . "\n";
    echo "Karyawan: " . $cuti->user->name . "\n";
    
    // Test view rendering
    $html = view('surat.cuti', [
        'karyawan' => $cuti->user,
        'cuti' => $cuti,
        'logoDataUri' => '',
    ])->render();
    
    echo "View rendered: " . strlen($html) . " characters\n";
    
    // Test Dompdf
    $dompdf = new \Dompdf\Dompdf([
        'isRemoteEnabled' => false,
        'isPhpEnabled' => false,
    ]);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    echo "PDF rendered successfully\n";
    
} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
?>
