<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class Lang
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
        // set local lang
        app()->setLocale( app( 'lang' ) );
        // set Carbon lang
        Carbon ::setLocale( app( 'lang' ) );
        // redirect to next url

        return $next($request);
    }
}
