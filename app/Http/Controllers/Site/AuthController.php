<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\checkUpdatePhoneCodeRequest;
use App\Http\Requests\Api\Auth\ProviderRegisterRequest;
use App\Http\Requests\Api\Auth\ForgetPasswordRequest;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Http\Requests\Api\Auth\NewPasswordRequest;
use App\Http\Requests\Api\User\EditPasswordRequest;
use App\Http\Requests\Api\User\updatePhoneRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\ActivateRequest;
use App\Http\Resources\Api\AccountTypeResource;
use App\Http\Requests\Api\Auth\SignInRequest;
use App\Http\Resources\Api\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Models\AccountType;
use App\Models\UserUpdate;
use App\Traits\Responses;
use App\Models\UserToken;
use App\Models\User;
use App\Models\City;
use Carbon\Carbon;
use Validator;
use Session;
Use Alert;
use Auth;

class AuthController extends Controller
{
    use Responses;

    /**  public function Sign Up . */
    public function SignUp()
    {
        $cities = City::latest()->get();

        return view('site.auth.sign_up', get_defined_vars());
    }

    /**  public function sign Up User . */
    public function postSignUp(RegisterRequest $request)
    {
        $dataExcept = Arr::except($request->validated(), ['device_id','device_type','mac_address']);

        $dataExcept['code']             = $this->activation();
        $dataExcept['uuid']             = (string)Str::uuid();
        $dataExcept['code_expire']      = Carbon::now()->addMinute();

        $user = User::create($dataExcept);

        $user->update(['qr'=>generateQr($user)]);

        Session::put('user',$user);

        return redirect('activate-code');
    }

    /**  public function activate Code . */
    public function activateCode()
    {
        return view('site.auth.activate_code');
    }

    // activate account after register with code
    public function postActivateCode(Request $request)
    {
        $code = implode('',$request->code);
        $user = Session::get('user');

        if (!isset($user)) { return redirect('sign-in'); }

        if (!isset($code)){

            Alert::warning(trans('auth.code_invalid'));
            return back();
        }

        if($user->code == $code){

            $user->update(['code' => null , 'code_expire' => null , 'active' => 1]);
            Auth::login($user);

            Alert::success(trans('auth.activated'));
            return redirect('/');

        }else{

            Alert::error(trans('auth.code_invalid'));
            return back();
        }
    }
    // resend code function
    public function resendCode(){

        $user = Session::get('user');
        $user->update(['code' => $this->activation() , 'code_expire' => Carbon::now()->addMinute()]);

        Alert::success(trans('auth.code_re_send'));

        return back();
    }

    /**  public function sign In . */
    public function signIn()
    {
        return view('site.auth.sign_in');
    }

    // sign in  to auth users
    public function postSignIn(SignInRequest $request)
    {
        $remember = $request->remember;

        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password], $remember)) {

            if (Auth::user()->active == 0){

                Alert::warning(trans('site.need_activate'));
                
                ### SEND SMS ###
                $user = User::find(Auth::id());
                Session::put('user', $user);

                Auth::logout();
                return redirect('/activate-code');
            }

            return redirect('/');

        }else{

            Alert::warning(trans('auth.incorrect'));

            return back();
        }

    }

    /**  public function forget Password . */
    public function forgetPassword()
    {
        return view('site.auth.forget_password');
    }

    // forget password request
    public function postForgetPassword(ForgetPasswordRequest $request){

        $user = User::wherePhone($request->phone)->first();

        $user->update(['code'=>$this->activation()]);

        Session::put('user', $user);

        Alert::success(trans('auth.code_re_send'));

        return redirect('code-forget-password');
    }

    public function codeForgetPassword()
    {
        return view('site.auth.code_forget_password');
    }

    public function checkCodeForget(Request $request)
    {
        $code  = implode("", $request->code);

        if (!isset($code)){
            Alert::warning(trans('auth.code_invalid'));
            return back();
        }

        $getUser = Session::get('user');
        $user    = User::where('phone',$getUser->phone)->first();

        if ($code == $user->code ){
            return redirect('/new-password');

        }else{
            Alert::error(trans('auth.code_invalid'));
            return back();
        }
    }

    /**  public function new password . */
    public function newPassword()
    {
        $user = Session::get('user');
        if (!isset($user)) { abort(404);}

        return view('site.auth.new_password');
    }

    /**  public function post new password . */
    public function postNewPassword(NewPasswordRequest $request)
    {
        $user = Session::get('user');
        $user->update(['password' => $request->password ]);

        Alert::success(trans('apis.passwordReset'));
        Session::forget('user');

        return redirect('sign-in');
    }


    // edit password for auth user
    public function EditPassword(EditPasswordRequest $request)
    {
        if (!\Hash::check($request['old_password'], auth()->user()->password))
            $this->response('fail',trans('auth.incorrect_pass'));

        auth()->user()->update(['password' => $request['password'] ]);

        return $this->responseJsonData([],trans('apis.passwordReset'));
    }

    public function logout()
    {
        auth()->logout();

        Alert::success(trans('apis.loggedOut'));

        return redirect('/');
    }

    // resend activation code for user
    public function updateCode(){
        auth()->user()->update(['code' => $this->activation() , 'code_expire' => Carbon::now()->addMinute()]);
    }
}
