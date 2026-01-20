<?php

namespace App\Providers;

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
        // listen to logout event and revoke web-session tokens
        \Illuminate\Support\Facades\Event::listen(\Illuminate\Auth\Events\Logout::class, function ($event) {
            try {
                $user = $event->user;
                if ($user) {
                    $user->tokens()->where('name', 'web-session')->delete();
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Failed to revoke web-session token: ' . $e->getMessage());
            }
        });
    }
}
