<?php

namespace App\Providers;

use App\Models\UserNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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

        View::composer('layouts.frontend-header-sidebar', function ($view) {
            $unreadCount = 0;

            if (Auth::check()) {
                $unreadCount = UserNotification::where('user_id', Auth::id())
                    ->where('status', 'unread')
                    ->count();
            }

            $view->with('unreadCount', $unreadCount);
        });
    }
}
