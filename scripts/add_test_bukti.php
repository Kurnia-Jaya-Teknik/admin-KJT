<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Storage;
use App\Models\Cuti;

// create test file
Storage::disk('public')->put('cuti-bukti/test.txt','dummy content');
$exists = Storage::disk('public')->exists('cuti-bukti/test.txt') ? 'OK' : 'FAIL';
echo "file: $exists\n";

// attach to an existing cuti
$cuti = Cuti::first();
if ($cuti) {
    $cuti->bukti = 'cuti-bukti/test.txt';
    $cuti->save();
    echo "attached to cuti id={$cuti->id}\n";
} else {
    echo "no cuti records\n";
}
