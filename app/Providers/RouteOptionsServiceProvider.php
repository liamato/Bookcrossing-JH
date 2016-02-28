<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Collection;
use App\Providers\RouteServiceProvider as ServiceProvider;

class RouteOptionsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $router->pattern('options', '\(((?:[^,=()\s]+,?)+|(?:[^,=()\s]+=[^,=()\s]+,?)+)\)');

        parent::boot($router);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('RouteOptions', function ($app) {
            return new Collection;
        });
    }
}
