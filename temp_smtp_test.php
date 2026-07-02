<?php

require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
Illuminate\Support\Facades\Facade::setFacadeApplication($app);

$user = new App\Models\User();
$user->name = 'Test User';
$user->email = 'prosperibe834@gmail.com';

$mail = new App\Mail\PasswordResetOtpMail($user, '123456');

try {
    Illuminate\Support\Facades\Mail::to($user->email)->send($mail);
    echo 'SENT';
} catch (Throwable $e) {
    echo 'ERROR: ' . $e->getMessage();
}
