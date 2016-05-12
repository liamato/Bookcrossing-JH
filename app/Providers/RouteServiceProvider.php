<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        //

        $router->pattern('id', '[0-9]+');
        $router->pattern('scId', '[0-9]+');
        $router->pattern('book', '[0-9]+');
        $router->pattern('category', '[0-9]+');
        $router->pattern('news', '[0-9]+');
        $router->pattern('post', '[0-9]+');
        $router->pattern('school', '[0-9]+|[A-Za-z\-]+');
        $router->pattern('user', '[0-9]+');
        $router->pattern('video', '[0-9]+');

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routesApi.php');
            require app_path('Http/routesAdmin.php');
            require app_path('Http/routes.php');
        });
    }
}
