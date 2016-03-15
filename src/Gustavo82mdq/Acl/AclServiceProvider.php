<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AclServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__.'/assets' => public_path('gustavo82mdq/acl')], 'public');

        if (! $this->app->routesAreCached()) {
            require __DIR__.'/../../config/routes.php';
        }

        $this->loadViewsFrom(__DIR__.'/Views', 'acl');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
