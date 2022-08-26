<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Complaints\StoreComplaintRequest;
use App\Http\Requests\Api\User\EditProfileRequest;
use App\Http\Resources\Api\NotificationsResource;
use App\Http\Requests\Api\User\CommentRequest;
use App\Http\Requests\Api\User\BankTransfers;
use App\Http\Resources\Api\UserResource;
use App\Repositories\EstateRepository;
use App\Jobs\ApiNotification;
use App\Models\BankTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\SiteSetting;
use App\Models\UserUpdate;
use App\Models\Complaint;
use App\Traits\Responses;
use App\Models\Favorite;
use App\Models\Comment;
use App\Models\Estate;
use App\Models\Bank;
use App\Models\Offer;
use App\Models\Like;
use Carbon\Carbon;
use Validator;
use Session;
use JWTAuth;
use Auth;
use Alert;
use DB;

class UserController extends Controller
{
    use Responses;

    private $EstateRepository;

    public function __construct(EstateRepository $EstateRepository)
    {
        $this->EstateRepository = $EstateRepository;
    }

    /**  public function favorite . */
    public function favorite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'estate_id' => 'required|exists:estates,id',
        ]);

        if ($validator->passes()) {

            $user     = Auth::user();
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

    /**  public function user estates . */
    public function myEstates()
    {
        $user    = Auth::user();
        $data    = Estate::where(['user_id'=>$user->id,'archive'=>0])->with('likes')->latest()->get();
        $estates = $this->EstateRepository->estates($data);

        return view('site.my_estates', get_defined_vars());
    }

    /**  public function archived estates. */
    public function archivedEstates()
    {
        $user   = Auth::user();
        $data   = Estate::where(['user_id'=>$user->id,'archive'=>1])->with('likes')->latest()->get();

        $estates = $this->EstateRepository->estates($data);

        return view('site.archived_estates', get_defined_vars());
    }

    /**  public function my favorites . */
    public function myFavorites()
    {
        $user   = Auth::id();

        $favorites = Favorite::where(['user_id'=>$user])->pluck('estate_id')->toArray();
        $data      = Estate::with('likes')->whereIn('id',$favorites)->latest()->get();
        $estates   = $this->EstateRepository->estates($data);

        return view('site.my_favorites', get_defined_vars());
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

    /**  public function transfer . */
    public function transfer(Request $request)
    {
        if (!isset($request->amount) || $request->amount <= 0 ){

            Alert::warning(trans('site.amount_required'));

            return back();
        }

        $data  = (int) SiteSetting::where(['key' => $request->type])->firstOrFail()->value;

        $price =  $data  * (int) $request->amount / 100 ;

        Session::put('transfer',['price'=>$price,'type'=>$request->type]);

        return  redirect('bank-transfer');
    }

    /**  public function bank transfer . */
    public function bankTransfer()
    {
        $price = session()->has('transfer') ?  Session::get('transfer')['price'] : null;
        $type  = session()->has('transfer')  ?  Session::get('transfer')['type'] : null;

        $banks = Bank::select('bank_name','account_name','account_number','iban_number','image')->get();

        return view('site.bank_transfer',get_defined_vars());
    }

    /**  public function bank transfer . */
    public function postBankTransfer(BankTransfers $request)
    {
        if (! isset($request->image)){

            Alert::error(trans('site.transfer_image'));
            return back();
        }

        $dataExcept = Arr::except($request->validated(), ['image']);

        $dataExcept['user_id'] = Auth::id();
        $dataExcept['image']   = uploadFile($request->image,'BankTransfers');

        BankTransfer::create($dataExcept);

        return redirect('paid-successfully');
    }

    /**  public function paid_successfully . */
    public function paidSuccessfully()
    {
        return view('site.paid_successfully');
    }

    /**  public function account . */
    public function account()
    {
        return view('site.account');
    }

    // profile data
    public function profile(){

        return view('site.profile');
    }

    // UPDATE PROFILE
    public function updateProfile(EditProfileRequest $request){

        auth()->user()->update(array_filter($request->validated()));

        Alert::success(trans('apis.updated'));

        return redirect('profile');

    }
}
