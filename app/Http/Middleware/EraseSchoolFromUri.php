<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use App\School;

class EraseSchoolFromUri
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $school = \App::make(School::class);
        Route::current()->forgetParameter('school');
        $response = $next($request);
        Route::current()->setParameter('school', $school->slug);
        return $response;
    }
}
