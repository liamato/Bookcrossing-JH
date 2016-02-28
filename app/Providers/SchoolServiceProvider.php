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
        $this->app->bindShared(School::class, function(){
            if (Route::current()){
                if (Route::current()->hasParameter('school')){
                    $school = Route::current()->getParameter('school');
                    if (is_numeric($school)) {
                        return School::find($school);
                    }
                    return School::bySlug($school);
                }
            }
            return new School;
        });
    }
}
