<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Services\SettingService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\loginRequest ;

class AuthController extends Controller
{
    /***************** change lang  *****************/
    public function SetLanguage($lang)
    {
        if ( in_array( $lang, [ 'ar', 'en' ] ) ) {

            if ( session() -> has( 'lang' ) )
                session() -> forget( 'lang' );

            session() -> put( 'lang', $lang );

        } else {
            if ( session() -> has( 'lang' ) )
                session() -> forget( 'lang' );

            session() -> put( 'lang', 'ar' );
        }
        return back();
    }

    /***************** show login form *****************/
    public function showLoginForm()
    {
        $data =  SettingService::appInformations(SiteSetting::pluck('value', 'key'));
        return view('admin.auth.login' , compact('data'));
    }

    /**************** show login form *****************/
    public function login(loginRequest $request)
    {
        $remember = $request->remember == 1 ? true : false;
        if (auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember)){
            session() -> put( 'lang', 'ar' );
            return response()->json(['status' => 'login' ,'url' => url('/admin/dashboard') , 'message' => awtTrans('تم تسجيل الدخول بنجاح') ]);
        }else{
            return response()->json(['status' => 0 ,'message' => awtTrans('كلمة السر غير صحيحة') ]);
        }
    }

    /**************** logout *****************/
    public function logout()
    {
        auth('admin')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect(route('admin.login'));
    }
}
