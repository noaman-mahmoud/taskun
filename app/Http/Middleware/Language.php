<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Language
{
    public function handle($request, Closure $next)
    {
        Session::has('language') ? App::setLocale(Session('language')) : App::setLocale('ar');
        return $next($request);
    }
}
