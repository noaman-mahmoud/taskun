<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Estate\AddDetailsEstate;
use App\Http\Requests\Api\Estate\AddEstate;
use App\Http\Requests\Api\Estate\EditEstate;
use App\Http\Requests\Api\Estate\EstatesFilter;
use App\Http\Requests\Api\Estate\EstatesSearch;
use App\Http\Requests\Api\Estate\EstateUserContacts;
use App\Http\Requests\Api\Estate\SearchEstatesProvider;
use App\Repositories\EstateRepository;
use App\Jobs\ApiNotification;
use App\Models\EstateAddition;
use App\Models\EstateContact;
use App\Models\EstateFeature;
use Illuminate\Http\Request;
use App\Models\EstateImage;
use Illuminate\Support\Arr;
use App\Traits\Responses;
use App\Models\Feature;
use App\Models\Option;
use App\Models\Estate;
use App\Models\User;
use Carbon\Carbon;
use Validator;
use JWTAuth;

class EstateController extends Controller
{
    use Responses;

    private $EstateRepository;

    public function __construct(EstateRepository $EstateRepository)
    {
        $this->EstateRepository = $EstateRepository;
    }

    /**  public function features . */
    public function features()
    {
        $features = Feature::get();
        $data     = [];

        foreach ($features as $feature){

            $options = Option::where(['feature_id'=>$feature->id])->get();
            $options_data = [];

            foreach ($options as $option){

                $options_data [] = [
                    'id'    => $option->id,
                    'name'  => $option->name,
                    'value' => isset($option->value) ? $option->value : '',
                ];
            }

            $data []  = [
                'id'          => $feature->id,
                'name'        => $feature->feature,
                'type'        => $feature->type->type,
                'options'     => isset($options) ? $options_data : [],
                'value'       => '',
                'value_id'    => '',
            ];

        }

        return $this->responseJsonData($data);
    }

    /**  public function add_estate Step [1]  . */
    public function addEstate(AddEstate $request)
    {
        $validator = Validator::make($request->all(), [
            "images"             => "required|array",
            'images.*'           => 'required',
        ]);

        if ($validator->fails()){
            $error = Arr::first(Arr::flatten($validator->messages()->get('*')));

            return response()->json(["key"=>"fail","msg"=>$error]);
        }

        $dataExcept = Arr::except($request->validated(), ['images']);

        $dataExcept['user_id']   = JWTAuth::toUser()->id;
        $dataExcept['user_type'] = JWTAuth::toUser()->user_type;

        $estate = Estate::create($dataExcept);

        if (isset($request->images)){

            $images = $request->images;

            foreach ($images as $image){
                EstateImage::create([
                    "estate_id" => $estate->id,
                    "image"     => uploadFile($image,'estate_images'),
                ]);
            }
        }

        return $this->responseJsonData($estate->id,trans('apis.add_successfully'));
    }

    /**  public function add details estate Step [2] . */
    public function addDetailsEstate(AddDetailsEstate $request)
    {

        $jwtUser = JWTAuth::toUser();
        $estate  = Estate::where(['id'=>$request->estate_id,'user_id'=>$jwtUser->id])->first();

        if (!isset($estate)){

            return $this->responseJsonError(trans('apis.data_incorrect'));
        }

        $features = json_decode($request->features,true);

        foreach ($features as $feature){
            EstateFeature::updateOrCreate(
                [ 'estate_id' => $estate->id, 'feature_id' =>$feature['feature_id'] ],
                [
                    'option_id' => in_array($feature['type'],['radio','select']) ? $feature['value'] : null,
                    'type'      => $feature['type'],
                    'value'     => $feature['value'],
                ]
            );
        }

        if (isset($request->additions)){

            foreach (explode(',',$request->additions) as $addition){

                EstateAddition::updateOrCreate(
                    [ 'estate_id' => $estate->id , 'addition_id'=>$addition],
                    [
                      'addition_id' => $addition,
                    ]
                );
            }
        }

        $estate->update(['description'=>$request->description]);

        return $this->responseJsonData($estate->id,trans('apis.add_successfully'));
    }

    /**  public function estate user contacts Step [3]  . */
    public function estateUserContacts(EstateUserContacts $request)
    {
        $jwtUser    = JWTAuth::toUser();
        $estate     = Estate::where(['id'=>$request->estate_id,'user_id'=>$jwtUser->id])->first();

        $dataExcept = Arr::except($request->validated(), ['estate_id','phones']);

        if (!isset($estate)){

            return $this->responseJsonError(trans('apis.data_incorrect'));
        }

        if (isset($request->phones)){

            foreach (explode(',',$request->phones) as $phone){

                EstateContact::updateOrCreate(
                    ['estate_id' => $estate->id , 'phone'=>$phone] , ['phone' => $phone]
                );

                $data_phones [] = [$phone];
            }

            EstateContact::where(['estate_id'=>$estate->id])->whereNotIn('phone',$data_phones)->delete();
        }

        $estate->update($dataExcept);

        return $this->responseJsonData($estate->id,trans('apis.add_successfully'));
    }

    /**  public function confirm estate . */
    public function confirmEstate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'estate_id' => 'required|exists:estates,id',
        ]);

        if ($validator->passes()) {

            $jwtUser    = JWTAuth::toUser();
            $estate     = Estate::where(['id'=>$request->estate_id,'user_id'=>$jwtUser->id])->first();

            if (!isset($estate)){

                return $this->responseJsonError(trans('apis.data_incorrect'));
            }

            $estate->update(['publish'=>1]);

            return $this->responseJsonData([],trans('apis.action_confirmed'));
        }

        $error = Arr::first(Arr::flatten($validator->messages()->get('*')));

        return response()->json(["key"=>"fail","msg"=>$error]);
    }

    /**  public function add estate Step [1]  . */
    public function editEstate(EditEstate $request)
    {
        $estate = Estate::where(['user_id'=> JWTAuth::toUser()->id,'id'=>$request->estate_id])->first();

        if (!isset($estate)){

            return $this->responseJsonData([],trans('apis.data_incorrect'));
        }

        $data = $this->EstateRepository->edit_estate($request->validated() , $estate);

        return $this->responseJsonData($data,trans('apis.successfully_updated'));
    }


    /**  public function delete estate . */
    public function deleteEstate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'estate_id' => 'required|exists:estates,id',
        ]);

        if ($validator->passes()) {

            $jwtUser = JWTAuth::toUser();
            $estate  = Estate::where(['id'=>$request->estate_id,'user_id'=>$jwtUser->id])->first();

            if (!isset($estate)){

                return $this->responseJsonError(trans('apis.data_incorrect'));
            }

            $estate->delete();

            return $this->responseJsonData([],trans('apis.deleted_successfully'));
        }

        $error = Arr::first(Arr::flatten($validator->messages()->get('*')));

        return response()->json(["key"=>"fail","msg"=>$error]);
    }

    /**  public function estate details . */
    public function estateDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'estate_id' => 'required|exists:estates,id',
        ]);

        if ($validator->passes()) {

            $estate  = Estate::with(['city','estateCategory','category','likes'])->find($request->estate_id);
            $estate->increment('views');

            $data    = $this->EstateRepository->estate_details($estate);

            $estates = Estate::where(['user_id'=>$estate->user_id,'publish'=>1])->with(['likes'])->latest()->get();

            $data['similar_estates'] = $this->EstateRepository->estates($estates);

            return $this->responseJsonData($data);
        }

        $error = Arr::first(Arr::flatten($validator->messages()->get('*')));

        return response()->json(["key"=>"fail","msg"=>$error]);
    }

    /**  public function estates Search . */
    public function estatesSearch(EstatesSearch $request)
    {
        $query   = Estate::with(['likes'])->where(['publish'=>1])->newQuery();

        $query   = $this->EstateRepository->estates_search($request->validated() ,$query);

        if (isset($query)){
            $estates   = $query->select('lat','lng');
            $distances = getDistance($estates,$request->lat,$request->lng);
        }

        $data = isset($query) ? $this->EstateRepository->estates($distances) : [];

        return $this->responseJsonData($data);
    }

    /**  public function search estates provider . */
    public function searchEstatesProvider(SearchEstatesProvider $request)
    {
        $query   = Estate::with(['likes'])->where(['publish'=>1,'user_id'=>$request->provider_id])->newQuery();

        $query   = $this->EstateRepository->estates_search($request->all() ,$query);

        $estates = $query->select('lat','lng');

        $distances = getDistance($estates,$request->lat,$request->lng);

        $data = $this->EstateRepository->estates($distances);

        return $this->responseJsonData($data);
    }

    /**  public function search estates filter . */
    public function estatesFilter(EstatesFilter $request)
    {
        $query   = Estate::with(['likes'])->where(['publish'=>1])->newQuery();

        $query   = $this->EstateRepository->estates_filter($request->validated() ,$query);

        if (isset($query)){

            $estates = $query->select('lat','lng');

            $distances = getDistance($estates,$request->lat,$request->lng);

        }

        $data = isset($query) ? $this->EstateRepository->estates($distances) : [];

        return $this->responseJsonData($data);
    }

    /**  public function update estate . */
    public function updateEstate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'estate_id' => 'nullable|exists:estates,id',
        ]);

        if ($validator->passes()) {

            $jwtUser  = JWTAuth::toUser();

            $estates  = Estate::when($request->estate_id, function ($query) use ($request){
                         $query->where('id',$request->estate_id);

            })->where(['user_id'=>$jwtUser->id])->update(['updated_at'=>Carbon::now()]);

            return $this->responseJsonData([],trans('apis.successfully_updated'));
        }

        $error = Arr::first(Arr::flatten($validator->messages()->get('*')));

        return response()->json(["key"=>"fail","msg"=>$error]);
    }
}
