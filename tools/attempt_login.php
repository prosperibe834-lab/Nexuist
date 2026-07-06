<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

$user = DB::table('users')->orderBy('id','desc')->first();
if (!$user) { echo "No user\n"; exit; }
$email = $user->email;
$password = 'secret123';

// Try plain check
$matches = Hash::check($password, $user->password);
echo "Hash check: " . ($matches ? 'true' : 'false') . PHP_EOL;

// Try Auth::attempt
$attempt = Auth::attempt(['email' => $email, 'password' => $password, 'is_admin' => true]);
echo "Auth::attempt result: " . ($attempt ? 'true' : 'false') . PHP_EOL;

// Also try without is_admin
$attempt2 = Auth::attempt(['email' => $email, 'password' => $password]);
echo "Auth::attempt without is_admin: " . ($attempt2 ? 'true' : 'false') . PHP_EOL;

