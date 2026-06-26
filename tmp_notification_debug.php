<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo 'USER_NOTIFICATIONS=' . App\Models\UserNotification::count() . "\n";
$user = App\Models\User::first();
if ($user) {
    echo 'FIRST_USER_ID=' . $user->id . "\n";
    echo 'FIRST_USER_NOTIFICATIONS=' . App\Models\UserNotification::where('user_id', $user->id)->count() . "\n";
    echo 'FIRST_USER_EMAIL=' . $user->email . "\n";
} else {
    echo 'NO_USER' . "\n";
}

echo "\nROUTE DEBUG:\n";
$routes = app('router')->getRoutes();
foreach ($routes as $route) {
    $uri = $route->uri();
    if (str_contains($uri, 'notifications')) {
        echo 'URI=[' . $uri . "] NAME=[" . ($route->getName() ?? 'null') . "] ACTION=[" . $route->getActionName() . "]\n";
    }
}
