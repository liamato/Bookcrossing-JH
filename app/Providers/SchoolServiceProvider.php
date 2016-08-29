<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Guard;
use App\School;
use Route;

class SchoolServiceProvider extends ServiceProvider
{

    protected $auth;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Guard $auth)
    {
        $this->auth = $auth;
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
                if ($this->auth->check() && \Auth::user()->isSuper()) {
                    return \Auth::user()->school;
                }
            }
            return new School;
        });
    }
}
