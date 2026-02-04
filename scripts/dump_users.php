<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$rows = DB::table('users')->select('id','name','email','username','is_active','created_at')->limit(20)->get();

if ($rows->isEmpty()) {
    echo "No users found in 'users' table.\n";
} else {
    foreach ($rows as $r) {
        echo json_encode($r) . "\n";
    }
}
