<?php
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Lembur;

$items = Lembur::with('user')->orderBy('created_at', 'desc')->limit(20)->get();
echo "Found " . $items->count() . " lembur rows\n";
foreach ($items as $l) {
    echo "ID: {$l->id} | user_id: {$l->user_id} | user: " . ($l->user->name ?? 'N/A') . " | tanggal: {$l->tanggal} | jam: {$l->jam_mulai}-{$l->jam_selesai} | durasi: {$l->durasi_jam} | status: {$l->status}\n";
}
