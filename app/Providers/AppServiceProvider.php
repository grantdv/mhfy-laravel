<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CartService;

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
        // Make cart count available to all views
        $this->makeCartCountAvailableToAllViews();
    }

    /**
     * Make cart count available to all views.
     */
    private function makeCartCountAvailableToAllViews(): void
    {
        if (method_exists($this->app['view'], 'composer')) {
            $this->app['view']->composer('*', function ($view) {
                $view->share('cartCount', CartService::getCartCount());
            });
        }
    }
}
