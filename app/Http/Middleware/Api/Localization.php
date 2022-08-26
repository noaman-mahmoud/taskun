<?php

namespace App\Http\Middleware\Api;
use App;
use Closure;
use Carbon\Carbon;
use App\Models\User;
use App\Traits\Expo ;

class localization
{
    public function handle($request, Closure $next)
    {
        $lang = 'ar' ;
        if (request('lang'))
            $lang = request('lang') ;
        else if($request->header('lang'))
            $lang = $request->header('lang') ;
        else if(auth()->check() && auth()->user()->lang != null)
            $lang = auth()->user()->lang ;

        App::setLocale($lang);

        Carbon::setLocale($lang);

        return $next($request);
    }
}
