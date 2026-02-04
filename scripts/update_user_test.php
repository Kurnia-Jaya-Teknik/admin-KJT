<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$id = $argv[1] ?? 3;
$status = $argv[2] ?? 'PKWTT';
$user = App\Models\User::find($id);
if (!$user) {
    echo "User not found\n";
    exit(1);
}
$user->status_kepegawaian = $status;
$user->save();
echo "Updated user {$user->id} status_kepegawaian={$user->status_kepegawaian}\n";
