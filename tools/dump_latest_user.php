<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
$users = DB::table('users')->orderBy('id', 'desc')->limit(10)->get();
if ($users->isEmpty()) {
    echo "No users found\n";
    exit(0);
}

foreach ($users as $user) {
    print_r($user);
    echo "-----------------\n";
}
