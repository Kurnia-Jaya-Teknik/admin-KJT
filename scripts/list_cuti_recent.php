<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

foreach (\App\Models\Cuti::orderBy('id','desc')->limit(10)->get() as $c) {
    echo $c->id . ' | ' . $c->user_id . ' | ' . $c->jenis . ' | ' . $c->status . ' | ' . $c->created_at . "\n";
}
