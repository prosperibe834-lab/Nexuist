<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Ensure application-wide mail sender is set (fallback to config/mail.php or .env)
        try {
            Mail::alwaysFrom(config('mail.from.address'), config('mail.from.name'));
        } catch (\Throwable $e) {
            // if mailer not available during certain artisan commands, silently ignore
        }
    }
}
