<?php

namespace App\Http\Middleware\Api;
use App\Traits\Responses;
use Carbon\Carbon;
use Closure;
use JWTAuth;
use Response;
use Exception;

class JwtMiddleware
{
    use Responses;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
             $user = JWTAuth::parseToken()->authenticate();

            if ($user === false){
                return $this->responseJsonError(trans('auth.invalid_token'));
            }
        }

        catch (Exception $e) {

            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){

                 return $this->responseJsonError(trans('auth.invalid_token'));

            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return  $this->responseJsonError(trans('auth.expired_token'));

            }else{

                return $this->responseJsonError(trans('auth.invalid_token'));
            }
        }

        return $next($request);
    }

    public function responseJsonError($message , $key = 'fail')
    {
        $response = ['key' => $key ,'msg' => $message ];

        return Response::json($response, 422);
    }

}
