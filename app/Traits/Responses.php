<?php

namespace App\Traits;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Favorite;
use JWTAuth;

trait Responses
{
    public function paginationModel($col)
    {
        $data = [
            'total'             => $col->total() ?? '',
            'count'             => $col->count() ?? '',
            'per_page'          => $col->perPage() ?? '',
            'next_page_url'     => $col->nextPageUrl() ?? '',
            'perv_page_url'     => $col->previousPageUrl() ?? '',
            'current_page'      => $col->currentPage() ?? '',
            'total_pages'       => $col->lastPage() ?? '',
        ];

        return $data;
    }

    /**
     * keys : success, fail, needActive, unauthenticated, blocked
    */

    function response($key, $msg, $data = [], $anotherKey = [], $page = false)
    {
        if( auth()->check() )   {
            if(auth()->user()->ban)
                $key =  'blocked';

            if(!auth()->user()->active)
                $key = 'needActive';
        }

        $allResponse['key'] = (string)$key;
        $allResponse['msg'] = (string)$msg;

        if ($data != [] && ($key == 'success' || $key == 'needActive')) {
            $allResponse['data'] = $data;
        }

        if (request('page')) {
            $allResponse['pagination'] = $this->paginationModel($data);
        }

        if (!empty($anotherKey)) {
            foreach ($anotherKey as $key => $value) {
                $allResponse[$key] = $value;
            }
        }

        throw new HttpResponseException(response()->json($allResponse, 200));
    }


    function activation(){
        $digits = 4;
        $random = rand(pow(10, $digits-1), pow(10, $digits)-1);
//      return (string) $random;
        return (string) 1234;
    }


    #keys : success, needActive, blocked , waitingApprove, exception

    function responseJsonData($data , $msg = "" , $key = 'success')
    {
        $response = ['key'=> $key,'msg'=>$msg,'data'=> $data];

        return $response;
    }

    #keys :fail, unauthenticated, blocked
    function responseJsonError($message , $key = 'fail')
    {
        $response = ['key' => $key ,'msg' => $message];

        return $response;
    }

    /**  public function is favorite. */
    function is_favorite($estate){

        $JwtToken = JWTAuth::getToken();

        if (isset($JwtToken)){

            $JwtUser  = JWTAuth::toUser();
            $favorite = Favorite::where(['user_id'=>$JwtUser->id , 'estate_id'=>$estate])->first();
            $data     = isset($favorite) ? 1 : 0;

        }else{
            $data     =  0;
        }

        return $data ;
    }
}
