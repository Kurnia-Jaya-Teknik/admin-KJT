<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$data = \App\Models\Magang::where('status', 'Permintaan Surat')->get();

echo "📊 Total Permintaan Surat: " . $data->count() . PHP_EOL . PHP_EOL;

foreach($data as $m) {
    echo "👤 Peserta: " . $m->nama_peserta . PHP_EOL;
    echo "   Institusi: " . $m->sekolah_asal . PHP_EOL;
    echo "   Nomor Diminta: " . $m->nomor_surat_diminta . PHP_EOL;
    echo "   Tanggal: " . optional($m->tanggal_surat_diminta)->format('d/m/Y') . PHP_EOL;
    echo "   Durasi: " . $m->durasi_hari . " hari" . PHP_EOL;
    echo "   Status: " . $m->status . PHP_EOL;
    echo "---" . PHP_EOL;
}
