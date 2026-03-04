<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Surat;

echo "=== CEK STATUS SURAT ===\n\n";

// Hitung per status
$statuses = Surat::select('status', \DB::raw('count(*) as total'))
    ->groupBy('status')
    ->get();

echo "Distribusi Status Surat:\n";
foreach ($statuses as $status) {
    echo "- {$status->status}: {$status->total} surat\n";
}

echo "\n";
echo "Total Surat: " . Surat::count() . "\n";
echo "Surat Diterbitkan: " . Surat::where('status', 'Diterbitkan')->count() . "\n";
echo "Surat Pending: " . Surat::whereIn('status', ['Draft', 'Menunggu Persetujuan', 'Pending'])->count() . "\n";

// Tampilkan 5 surat terbaru
echo "\n=== 5 SURAT TERBARU ===\n";
$recentSurat = Surat::with('user')->orderBy('created_at', 'desc')->take(5)->get();
foreach ($recentSurat as $surat) {
    echo "- ID: {$surat->id} | Jenis: {$surat->jenis} | Status: {$surat->status} | User: {$surat->user->name}\n";
}
