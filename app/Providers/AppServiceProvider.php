<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
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
        view()->composer('*', function ($view) {
            $guard = null;
            foreach (['admin', 'doctor', 'patient'] as $g) {
                if (Auth::guard($g)->check()) {
                    $guard = $g;
                    break;
                }
            }
            Auth::setDefaultDriver($guard);
        });
    }
}
