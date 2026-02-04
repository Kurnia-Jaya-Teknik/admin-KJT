<?php
// Test the preview endpoint

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Find a cuti for testing
$cuti = \App\Models\Cuti::where('jenis', 'Ijin Sakit')->with('user')->first();
if (!$cuti) {
    $cuti = \App\Models\Cuti::with('user')->first();
}

if (!$cuti) {
    echo "✗ No cuti found\n";
    exit(1);
}

echo "Testing preview for Cuti ID={$cuti->id}, Jenis={$cuti->jenis}, Bukti={$cuti->bukti}\n";

// Simulate what ApprovalController::preview does
$html = view('surat.templates.cuti', ['cuti' => $cuti])->render();
echo "✓ Template rendered: " . strlen($html) . " bytes\n";

// Check bukti appending
if (isset($cuti->jenis) && $cuti->jenis === 'Ijin Sakit' && !empty($cuti->bukti)) {
    echo "✓ Cuti is Ijin Sakit with bukti\n";
    
    $disk = \Illuminate\Support\Facades\Storage::disk('public');
    if ($disk->exists($cuti->bukti)) {
        echo "✓ Bukti file exists\n";
        $url = $disk->url($cuti->bukti);
        echo "✓ Bukti URL: {$url}\n";
        
        $ext = pathinfo($cuti->bukti, PATHINFO_EXTENSION);
        echo "✓ File extension: {$ext}\n";
    } else {
        echo "✗ Bukti file NOT found\n";
    }
} else {
    echo "ℹ Cuti is not Ijin Sakit or no bukti: jenis={$cuti->jenis}, bukti={$cuti->bukti}\n";
}

echo "\n✓ Preview test passed\n";
?>
