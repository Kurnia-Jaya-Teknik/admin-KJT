<?php
// Check if cuti with bukti exists and if files are accessible

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Check database
$cuti = \App\Models\Cuti::where('bukti', '!=', null)->first();
if ($cuti) {
    echo "✓ Found cuti with bukti: ID={$cuti->id}, bukti={$cuti->bukti}\n";
    $disk = \Illuminate\Support\Facades\Storage::disk('public');
    $exists = $disk->exists($cuti->bukti);
    echo ($exists ? "✓ File exists in storage\n" : "✗ File NOT found in storage\n");
    if ($exists) {
        $url = $disk->url($cuti->bukti);
        echo "✓ File URL: {$url}\n";
        
        // Check if file is actually readable
        $path = \Illuminate\Support\Facades\Storage::disk('public')->path($cuti->bukti);
        echo "✓ Full path: {$path}\n";
        echo (file_exists($path) ? "✓ File exists on disk\n" : "✗ File NOT on disk\n");
    }
} else {
    echo "✗ No cuti with bukti found in database\n";
    echo "Total cuti records: " . \App\Models\Cuti::count() . "\n";
    echo "Total cuti with bukti: " . \App\Models\Cuti::whereNotNull('bukti')->count() . "\n";
}
?>
