<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Validation\ValidationException;

$creator = new CreateNewUser();
$input = [
    'name' => 'Test Direktur 3',
    'email' => 'test-direktur3@example.com',
    'password' => 'Password123!',
    'password_confirmation' => 'Password123!',
    'role' => 'direktur',
    'verification_code' => env('DIREKTUR_CODE'),
];

try {
    $user = $creator->create($input);
    echo "CREATED: " . $user->id . " - " . $user->email . "\n";
    // cleanup
    $user->delete();
} catch (ValidationException $e) {
    echo "VALIDATION FAILED:\n";
    foreach ($e->errors() as $k => $v) {
        echo $k . ': ' . implode('; ', $v) . "\n";
    }
}
