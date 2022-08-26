<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\Api\Complaints\StoreComplaintRequest;
use App\Http\Requests\Api\User\EditProfileRequest;
use App\Http\Requests\Api\User\EstatesMainRequest;
use App\Http\Resources\Api\NotificationsResource;
use App\Http\Requests\Api\User\BankTransfers;
use App\Http\Resources\Api\UserResource;
use App\Repositories\EstateRepository;
use App\Http\Controllers\Controller;
use App\Models\BankTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Complaint;
use App\Traits\Responses;
use App\Models\Favorite;
use App\Models\Estate;
use App\Models\Like;
use App\Models\User;
use Carbon\Carbon;
use Validator;
use JWTAuth;
use DB;

class UserController extends Controller
{
    use Responses;

    private $EstateRepository;

    public function __construct(EstateRepository $EstateRepository)
    {
        $this->EstateRepository = $EstateRepository;
    }

    /**  public function estates main . */
    public function estatesMain(EstatesMainRequest $request)
    {
        $estates = Estate::when($request->city_id, function ($query) use ($request){
            $query->where('city_id',$request->city_id);
        })->where(['publish'=>1])->with(['likes']);

        if (isset($request->search)){
            $estates   = $estates->where('address', 'LIKE', '%' . $request->search . '%')->select('lat','lng');
        }else{
            $estates   = $estates->select('lat','lng');
        }

        $distances = getDistance($estates,$request->lat,$request->lng);

        $data = $this->EstateRepository->estates($distances);

        return $this->responseJsonData($data);
    }

    /**  public function favorite . */
    public function favorite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'estate_id' => 'required|exists:estates,id',
        ]);

        if ($validator->passes()) {

            $user     = JWTAuth::toUser();
            $favorite = Favorite::where(['user_id'=>$user->id ,'estate_id'=>$request->estate_id])->first();

            if (isset($favorite)){

                $favorite->delete();

                return $this->responseJsonData(0 ,trans('apis.removed_favorite'));
            }else

            Favorite::create(['user_id'=> $user->id,'estate_id' => $request->estate_id]);

            return $this->responseJsonData(1 ,trans('apis.added_favorite'));

        }

        $error = Arr::first(Arr::flatten($validator->messages()->get('*')));

        return response()->json(["key"=>"failed","msg"=>$error]);
    }

    /**  public function my favorites . */
    public function myFavorites()
    {
        $JwtUser   = JWTAuth::toUser()->id;
        $favorites = Favorite::where(['user_id'=>$JwtUser])->pluck('estate_id')->toArray();

        $estates   = Estate::with('likes')->whereIn('id',$favorites)->latest()->get();

        $data      = $this->EstateRepository->estates($estates);

        return $this->responseJsonData($data);
    }

    /**  public function like . */
    public function like(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'estate_id' => 'required|exists:estates,id',
        ]);

        if ($validator->passes()) {

            $user = JWTAuth::toUser();

            $like  = Like::where('users', 'LIKE', "%{$user->id}%")->where('estate_id',$request->estate_id)->first();

            if (isset($like)){

                $users = array_diff($like->users, [$user->id]);

                $like->update(['users'=>array_values($users) ,'count' => DB::raw('count - 1')]);

                if (empty($like->users)) $like->delete();

                return $this->responseJsonData(0 ,trans('apis.removed_like'));

            }else{

                $likes  = Like::where('estate_id',$request->estate_id)->whereDate('created_at',Carbon::today())->first();

               if ( isset($likes) )

                    $likes->update([
                    'estate_id' => $request->estate_id,
                    'users'     => Arr::prepend($likes->users,$user->id),
                    'count'     => DB::raw('count + 1')]);

               else

                 Like::create(['estate_id' => $request->estate_id,'users'=>[$user->id]])->increment('count');

                 return $this->responseJsonData(1 ,trans('apis.added_like'));
            }
        }

        $error = Arr::first(Arr::flatten($validator->messages()->get('*')));

        return response()->json(["key"=>"failed","msg"=>$error]);
    }

    /**  public function bank transfer . */
    public function bankTransfer(BankTransfers $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
        ]);

        if (!$validator->passes()) {

            $error = Arr::first(Arr::flatten($validator->messages()->get('*')));
            return response()->json(["key"=>"failed","msg"=>$error]);
        }

        $dataExcept = Arr::except($request->validated(), ['image']);

        $dataExcept['user_id'] = JWTAuth::toUser()->id;
        $dataExcept['image']   = uploadFile($request->image,'BankTransfers');

        BankTransfer::create($dataExcept);

        return $this->responseJsonData([],trans('apis.action_confirmed'));
    }

    // profile data
    public function profile(){

        return $this->responseJsonData(new UserResource(auth()->user()),trans('apis.add_successfully'));
    }

    // CHANGE NOTIFY STATUS
    public function changeNotifyStatue()
    {
        $user = auth()->user() ;
        $user->update(['is_notify' => !$user->is_notify  ]);
        $msg = $user->is_notify ? __('apis.openNotify') : __('apis.closeNotify');

        return $this->responseJsonData(['status' => $user->is_notify],$msg);
    }

    // NOTIFICATIONS
    public function notifications()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return $this->responseJsonData(NotificationsResource::collection(auth()->user()->notifications));
    }

    // COUNT NOTIFICATIONS
    public function countNotifications()
    {
        return $this->responseJsonData(['count' => auth()->user()->unreadNotifications->count()]);
    }

    // DELETE NOTIFICATIONS
    public function deleteNotifications(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'notification_id' => 'required|exists:notifications,id',
        ]);

        if ($validator->passes()) {

            auth()->user()->notifications()->where('id', $request->notification_id)->first()->delete();

            return $this->responseJsonData([],trans('site.notify_deleted'));
        }

        $error = Arr::first(Arr::flatten($validator->messages()->get('*')));

        return response()->json(["key"=>"failed","msg"=>$error]);

    }

    // UPDATE PROFILE
    public function updateProfile(EditProfileRequest $request)
    {
        $checkPhone = User::wherePhone($request->phone)->where('id','<>' , auth()->id())->first();
        $checkEmail = User::wherePhone($request->email)->where('id','<>' , auth()->id())->first();

        if (isset($request->phone) && isset($checkPhone)){
            return $this->responseJsonError(trans('auth.phoneExist'));
        }

        if (isset($request->email) && isset($checkEmail)){

            return $this->responseJsonError(trans('auth.emailExist'));
        }

        if (!empty($request->validated())){

            auth()->user()->update($request->validated());
        }

        return $this->responseJsonData(new UserResource(auth()->user()),trans('apis.updated'));

    }

    /**  public function switch_notification . */
    public function switchNotification(Request $request)
    {
        $JwtUser = JWTAuth::toUser();

        if (isset($request->switch)){
            $msg = $request->switch == 1 ? trans('apis.openNotify') : trans('apis.closeNotify');
            $JwtUser->update(['is_notify' => $request->switch]);
        }

        return $this->responseJsonData((int)$JwtUser->is_notify , isset($request->switch) ? $msg : '');
    }

    public function complaints(StoreComplaintRequest $request)
    {
        $JWTUser    = JWTAuth::toUser()->id;

        if (count($request->all()) > 0 ){

            $dataExcept = Arr::except($request->validated(), ['message']);
            $dataExcept['title']     = $request->title;
            $dataExcept['complaint'] = $request->message;
            $dataExcept['user_id']   = $JWTUser;

            Complaint::create($dataExcept);
        }

        $complaints = Complaint::where(['user_id'=>$JWTUser])->select('title','complaint')->latest()->get();

        return $this->responseJsonData($complaints,trans('apis.messageSended'));
    }
}
