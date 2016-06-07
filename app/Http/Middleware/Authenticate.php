<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Route;
use App;
use App\School;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $school = App::make(School::class);
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response(['response' => 'Unautorized', 'responseCode' => 401], 401);
            } else {
                return redirect()->guest(route('login'));
            }
        }
        if (!$this->auth->user()->inSchool($school)) {
            $params = [];
            foreach(Route::current()->parameterNames() as $order => $pm){
                if ($pm == 'school') {
                    $params[$order] = $this->auth->user()->school->slug;
                } else {
                    $params[$order] = Route::current()->getParameter($pm);
                }
            }
            return redirect()->route(Route::current()->getName(), $params);
        }

        return $next($request);
    }
}
