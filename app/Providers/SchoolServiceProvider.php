<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\School;
use Route;

class SchoolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        \App::bindShared(School::class, function(){
            if (Route::current()->hasParameter('school')){
                return School::bySlug(Route::current()->getParameter('school'));
            }
            return new School;
        });
    }
}
