<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$roles = ['direktur','admin_hrd','karyawan'];
foreach ($roles as $role) {
    echo "\nROLE: $role\n";
    $rows = DB::table('users')->where('role', $role)->select('id','name','email','status','created_at')->limit(20)->get();
    if ($rows->isEmpty()) {
        echo "  (no users)\n";
    } else {
        foreach ($rows as $r) {
            echo '  ' . json_encode($r) . "\n";
        }
    }
}
