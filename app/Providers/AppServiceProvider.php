<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Application Service Provider.
 * 
 * Registers the core application services used throughout the platform,
 * including the CartService for session-based shopping.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(App\Services\CartService::class, function ($app) {
            return new App\Services\CartService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
