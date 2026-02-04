<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$rows = \App\Models\Cuti::where('status','Ditolak')->orderBy('updated_at','desc')->get();
if ($rows->isEmpty()) {
    echo "No rejected cuti found.\n";
} else {
    foreach ($rows as $c) {
        echo $c->id . ' | user_id=' . $c->user_id . ' | jenis=' . $c->jenis . ' | status=' . $c->status . ' | disetujui_oleh=' . ($c->disetujui_oleh ?? 'NULL') . ' | created=' . $c->created_at . ' | updated=' . $c->updated_at . "\n";
    }
}
