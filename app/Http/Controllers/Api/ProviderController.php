<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\Api\Provider\GetProvidersRequest;
use App\Repositories\ProviderRepository;
use App\Repositories\EstateRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Traits\Responses;
use App\Models\Estate;
use App\Models\User;
use Validator;
use JWTAuth;

class ProviderController extends Controller
{
    use Responses;

    private $EstateRepository;
    private $ProviderRepository;

    public function __construct(EstateRepository $EstateRepository , ProviderRepository $ProviderRepository)
    {
        $this->EstateRepository   = $EstateRepository;
        $this->ProviderRepository = $ProviderRepository;
    }

    /**  public function providers . */
    public function providers(GetProvidersRequest $request)
    {
        if (isset($request->city_id)){
            $requests  = ['city_id'=>$request->city_id,'user_type'=>$request->type,'active'=>1 ,'block'=>0];
        }else{
            $requests  = ['user_type'=>$request->type,'active'=>1 ,'block'=>0];
        }

        if (isset($request->search)){

            $providers = User::where($requests)->where('name', 'LIKE', '%' . $request->search . '%')
                ->withCount('estates')->select('lat','lng');
        }else{

            $providers = User::where($requests)->withCount('estates')->select('lat','lng');
        }

        $distances = getDistance($providers,$request->lat,$request->lng);

        $data = $this->ProviderRepository->providers($distances);

        return $this->responseJsonData($data);
    }

    /**  public function provider details . */
    public function providerDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'provider_id' => 'required|exists:users,id',
        ]);

        if ($validator->passes()) {

            $provider = User::withCount(['estates'=> function($query){
                            $query->where('archive', 0);
                        }])->with(['estates'])->find($request->provider_id);

            $data = $this->ProviderRepository->provider_details($provider);

            $provider->increment('views');

            return $this->responseJsonData($data);
        }

        $error = Arr::first(Arr::flatten($validator->messages()->get('*')));

        return response()->json(["key"=>"fail","msg"=>$error]);
    }

    /**  public function estates . */
    public function providerEstates()
    {
        $user      = JWTAuth::toUser();
        $estates   = Estate::where(['user_id'=>$user->id,'archive'=>0])->with('likes')->latest()->get();

        $data = $this->EstateRepository->estates($estates);

        return $this->responseJsonData($data);
    }


    /**  public function archived estates. */
    public function archivedEstates()
    {
        $user      = JWTAuth::toUser();
        $estates   = Estate::where(['user_id'=>$user->id,'archive'=>1])->with('likes')->latest()->get();

        $data = $this->EstateRepository->estates($estates);

        return $this->responseJsonData($data);
    }

    /**  public function provider estate details . */
    public function providerEstateDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'estate_id' => 'required|exists:estates,id',
        ]);

        if ($validator->passes()) {

            $user   = JWTAuth::toUser();
            $estate = Estate::where(['user_id'=>$user->id,'id'=>$request->estate_id])
                ->with(['city','estateCategory','category','likes'])->first();

            if (!isset($estate)){

                return $this->responseJsonError(trans('apis.data_incorrect'));
            }

            $data = $this->EstateRepository->estate_details($estate);

            $data['username']      = isset($estate->username)      ? $estate->username      : '';
            $data['user_phone']    = isset($estate->user_phone)    ? $estate->user_phone    : '';
            $data['user_whatsapp'] = isset($estate->user_whatsapp) ? $estate->user_whatsapp : '';

            return $this->responseJsonData($data);
        }

        $error = Arr::first(Arr::flatten($validator->messages()->get('*')));

        return response()->json(["key"=>"fail","msg"=>$error]);
    }

    /**  public function estate archive . */
    public function estateArchive(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'estate_id' => 'required|exists:estates,id',
            'archive'   => 'required|in:1,0',
        ],[
            'archive.in' => 'type value [1] [0]',
        ]);

        if ($validator->passes()) {

            $user   = JWTAuth::toUser();
            $estate = Estate::where(['user_id'=>$user->id,'id'=>$request->estate_id])->first();

            if (!isset($estate)){

                return $this->responseJsonError(trans('apis.data_incorrect'));
            }

            $estate->update(['archive'=>$request->archive]);

            return $this->responseJsonData([],trans('apis.refreshed'));
        }

        $error = Arr::first(Arr::flatten($validator->messages()->get('*')));

        return response()->json(["key"=>"fail","msg"=>$error]);
    }


}
