<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== CHECKING CUTI DATA ===\n";
echo "Total Cuti: " . \App\Models\Cuti::count() . "\n";
echo "Cuti (jenis='Cuti'): " . \App\Models\Cuti::where('jenis', 'Cuti')->count() . "\n";
echo "Cuti (jenis='Ijin Sakit'): " . \App\Models\Cuti::where('jenis', 'Ijin Sakit')->count() . "\n";
echo "Cuti (jenis='Cuti Tahunan'): " . \App\Models\Cuti::where('jenis', 'Cuti Tahunan')->count() . "\n";
echo "\n=== SAMPLE DATA (First 3) ===\n";

$samples = \App\Models\Cuti::with('user')->take(3)->get();
foreach ($samples as $cuti) {
    echo "ID: {$cuti->id}, User: " . ($cuti->user->name ?? 'No User') . ", Jenis: {$cuti->jenis}, Status: {$cuti->status}\n";
}

echo "\n=== DISTINCT JENIS VALUES ===\n";
$jenis = \App\Models\Cuti::distinct()->pluck('jenis');
foreach ($jenis as $j) {
    echo "- $j\n";
}
