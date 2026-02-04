<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$emails = [
    'api_test@example.com',
    'apelgaming@gmail.com',
    'direktur@test',
    'admin@example.com',
];

foreach ($emails as $e) {
    $u = \App\Models\User::where('email', $e)->first();
    if ($u) {
        echo "FOUND: $e => id={$u->id} verified_at=" . ($u->email_verified_at ?? 'NULL') . " is_active=" . (isset($u->is_active) ? $u->is_active : 'N/A') . " password_hash=" . substr($u->password, 0, 20) . "\n";
    } else {
        echo "MISSING: $e\n";
    }
}
