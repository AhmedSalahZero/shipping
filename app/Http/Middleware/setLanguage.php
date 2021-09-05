<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class setLanguage
{

    public function handle(Request $request, Closure $next)
    {
        app()->setlocale( (array_key_exists('lang',$_COOKIE)  ?$_COOKIE['lang'] : 'ar'));

        return $next($request);
    }


}
