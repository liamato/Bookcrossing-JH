<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\ExtraObjects\RouteOptions
 */
class RouteOptions extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'RouteOptions';
    }
}
