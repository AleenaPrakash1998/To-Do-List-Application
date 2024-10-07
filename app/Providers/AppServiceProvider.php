<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('App\Services\NGeniusService', function ($app) {
            return new \App\Services\NGeniusService();
        });
    }

    public function boot(): void
    {
        //
    }
}
