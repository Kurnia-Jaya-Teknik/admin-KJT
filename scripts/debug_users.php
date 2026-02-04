<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$users = App\Models\User::select('id','name','email','status_kepegawaian','role','departemen_id')->whereIn('role', ['karyawan','magang','admin_hrd'])->get();
echo $users->toJson(JSON_PRETTY_PRINT);
