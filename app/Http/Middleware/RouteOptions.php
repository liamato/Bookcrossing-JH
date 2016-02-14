<?php

namespace App\Http\Middleware;

use Closure;
use RouteOptions as Options;

class RouteOptions
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
        $options = Route::current()->getParameter('options');
        
        if ($options) {
            if (strpos($options, '=') === false) {
                foreach (explode(',', $options) as $option) {
                    Options::push($option);                    
                }
            } else {
                foreach (explode(',', $options) as $key => $value) {
                    $option = explode('=', $option);
                    Options::put($option[0],$option[1])
                }
            }
            Route::current()->forgetParameter('options');
        }

        return $next($request);
    }
}
