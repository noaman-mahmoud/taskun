<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\Api\User\checkUpdatePhoneCodeRequest;
use App\Http\Requests\Api\Auth\ProviderRegisterRequest;
use App\Http\Requests\Api\Auth\ForgetPasswordRequest;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Http\Requests\Api\User\EditPasswordRequest;
use App\Http\Requests\Api\User\updatePhoneRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\ActivateRequest;
use App\Http\Resources\Api\AccountTypeResource;
use App\Http\Requests\Api\Auth\SignInRequest;
use App\Http\Resources\Api\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Models\AccountType;
use App\Models\UserUpdate;
use App\Traits\Responses;
use App\Models\UserToken;
use App\Models\User;
use Carbon\Carbon;
use JWTAuth;
use Validator;
use Hash;

class AuthController extends Controller
{
    use Responses;

    /**  public function account types . */
    public function accountTypes()
    {
        $types = AccountTypeResource::collection(AccountType::get());

        return $this->responseJsonData($types);
    }

    /**  public function sign Up User . */
    public function signUp(RegisterRequest $request)
    {
        $dataExcept = Arr::except($request->validated(), ['device_id','device_type','mac_address']);

        $dataExcept['code']             = $this->activation();
        $dataExcept['uuid']             = (string)Str::uuid();
        $dataExcept['code_expire']      = Carbon::now()->addMinute();

        $user  = User::create($dataExcept);

        $token = JWTAuth::fromUser($user);

        // save or update device id
        $this->updateDeviceId( $user , $request , $token);

        $user->update(['qr'=>generateQr($user)]);

        $_user = new UserResource(User::find($user->id));

       return $this->responseJsonData($_user,trans('apis.signed'));
    }

    // activate account after register with code , token
    public function activateCode(ActivateRequest $request){

         if(Carbon::parse(auth()->user()->code_expire)->isPast()){

             return $this->responseJsonError(trans('auth.code_expired'));
         }

        if(auth()->user()->code == $request['code']){

            auth()->user()->update(['code' => null , 'code_expire' => null , 'active' => 1]);

            $user = new UserResource(auth()->user());

            return $this->responseJsonData($user , trans('auth.activated'));
        }

        return $this->responseJsonError(trans('auth.code_invalid'));
    }

    // sign in  to auth users
    public function signIn(SignInRequest $request){
        
        $token = JWTAuth::attempt(['phone' => $request['phone'] , 'password' => $request['password'] ]);

        if(!$token){
           return $this->responseJsonError(trans('auth.incorrect'));
        }

        auth()->user()->update(['jwt_token'=>JWTAuth::fromUser(auth()->user())]);

        $user = new UserResource(auth()->user());

        // check that user is active if not active redirect to activation
        if(auth()->user()->active == false)
        {
            $code = $this->updateCode();

            return $this->responseJsonData($user,trans('auth.not_active'),'needActive');
        }

        // check that user is activation admin
        if(auth()->user()->activation_admin == 0)
        {
            return $this->responseJsonData($user,trans('auth.waiting_approve'),'waitingApprove');
        }

        // check that user is not blocked
        if(auth()->user()->block == true){

            auth()->logout();
            return $this->responseJsonError(trans('auth.blocked'),'blocked');
        }

        // save or update device id
        $this->updateDeviceId(auth()->user(), $request , $token);

        return $this->responseJsonData($user,trans('apis.signed'));
    }

    // forget password request
    public function forgetPassword(ForgetPasswordRequest $request){
        // get user with phone number
        $user    = User::wherePhone($request->phone)->first();

        // save activation code to user updates table
        $update = UserUpdate::updateOrCreate([
            'user_id'       => $user->id,
            'type'          => 'password',
        ],[
            'code'          => $this->activation(),
        ]);

        JWTAuth::fromUser($user);

        $user->update(['code'=> $this->activation()]);

        $_user = new UserResource(User::find($user->id));

        return $this->responseJsonData($_user,trans('auth.code_re_send'));
    }


    // reset password after check activation code
    public function resetPassword(ResetPasswordRequest $request)
    {
        $checkCode = User::where(['id'=> auth()->id() , 'code'=>$request->code])->first();

        if (!isset($checkCode)){
            return $this->responseJsonError(trans('auth.incorrect_code'));
        }

        auth()->user()->update(['password' => $request->password ]);

        return $this->responseJsonData(new UserResource(auth()->user()),trans('apis.passwordReset'));
    }

    // change phone request with send activation code
    public function updatePhoneRequest(updatePhoneRequest $request)
    {
        $update = UserUpdate::updateOrCreate([
            'user_id'       => auth()->id(),
            'type'          => 'phone',
        ],[
            'code'          => 1111,
            'phone'         => $request->phone,
        ]);

        return $this->responseJsonData([],trans('apis.send_activated'));
    }

    // check activation code and change phone
    public function checkUpdatePhoneCode(checkUpdatePhoneCodeRequest $request)
    {
        $update = UserUpdate::where([
            'user_id'    => auth()->id() ,
            'code'       => $request->code,
            'type'       => 'phone',
        ])->first();

        if (!$update){
            $this->response('fail' , __('site.code_wrong'));
        }

        auth()->user()->update(['phone' => $update->phone ]);
        $update->delete();

        return $this->responseJsonData(new UserResource(auth()->user()),trans('apis.phone_changed'));

    }

    // edit password for auth user
    public function EditPassword(EditPasswordRequest $request)
    {
        if (!\Hash::check($request['old_password'], auth()->user()->password))
            $this->response('fail',trans('auth.incorrect_pass'));

        auth()->user()->update(['password' => $request['password'] ]);

        return $this->responseJsonData([],trans('apis.passwordReset'));
    }

    // logout function
    public function Logout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mac_address' =>'required|exists:user_tokens,mac_address'
        ]);

        if ($validator->passes()) {

            UserToken ::where(['device_id' => $request->mac_address,'user_id'=> auth()->user()->id])->delete();

            return $this->responseJsonData([],trans('apis.loggedOut'));
        }
        return response()->json($validator->errors());
    }

    // delete token on logout
    public function deleteToken($user_id , $device_id)
     {
         UserToken ::where([
             'device_id'   => $device_id,
             'user_id'     => $user_id,
         ])->delete();

     }

     // create or update device id of user in users tokens table
     public function updateDeviceId($user , $request , $token ){
         $user->update(['jwt_token'=>$token]);

        UserToken::updateOrcreate( [
            'device_id'   => $request['device_id'],
            'mac_address' => $request['mac_address'],
        ],[
            'device_type'   => $request['device_type'] ,
            'mac_address'   => $request['mac_address'] ,
            'user_id'       => $user->id
        ]);
    }

    // resend activation code for user
    public function updateCode(){
        auth()->user()->update(['code' => $this->activation() , 'code_expire' => Carbon::now()->addMinute()]);
    }

    // resend code function
    public function resendCode(){

        $code = $this->updateCode();

        return $this->responseJsonData([],trans('auth.code_re_send'));
    }

}
