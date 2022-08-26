<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Estate\AddEstate;
use App\Http\Requests\Api\Estate\EditEstate;
use App\Http\Requests\Api\Estate\EstateContacts;
use App\Repositories\EstateRepository;
use App\Jobs\ApiNotification;
use App\Models\EstateAddition;
use App\Models\EstateContact;
use App\Models\EstateFeature;
use App\Models\EstateCategory;
use Illuminate\Http\Request;
use App\Models\EstateImage;
use Illuminate\Support\Arr;
use App\Models\Category;
use App\Models\Addition;
use App\Models\Feature;
use App\Models\Option;
use App\Models\Estate;
use App\Models\User;
use App\Models\City;
use Validator;
use Session;
use Alert;
use Auth;

class EstateController extends Controller
{
    private $EstateRepository;

    public function __construct(EstateRepository $EstateRepository)
    {
        $this->EstateRepository = $EstateRepository;
    }

    /**  public function features . */
    public function features()
    {
        $features = Feature::with('type')->get();
        $data     = [];

        foreach ($features as $feature){

            $options      = Option::where(['feature_id'=>$feature->id])->get();
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

        return $data;
    }

    /**  public function add estate . */
    public function addEstate()
    {
        $cities = City::latest()->get();
        $categories = Category::latest()->get();
        $estateCategories = EstateCategory::latest()->get();

        return view('site.estate.add_estate', get_defined_vars());
    }

    /**  public function add_estate Step [1]  . */
    public function postAddEstate(AddEstate $request)
    {
        if (! isset($request->images)){
            Alert::warning(trans('site.images_required'));
            return back();
        }

        $dataExcept = Arr::except($request->validated(), ['images']);

        $dataExcept['user_id']   = Auth::id();
        $dataExcept['user_type'] = Auth::user()->user_type;

        if (isset($request->images)){

            $images = $request->images;
            $data_images = [];

            foreach ($images as $image){
                $data_images [] = [
                    "image"     => uploadFile($image,'estate_images'),
                ];
            }
        }

        $dataExcept['images'] = $data_images;

        Session::put('add_estate',$dataExcept);
        Session::save();

        return  redirect('add-details-estate');
    }

    /**  public function add_details_estate . */
    public function addDetailsEstate()
    {
        $features  = $this->features();
        $additions = Addition::latest()->get();

        return view('site.estate.add_details_estate', get_defined_vars());
    }

    /**  public function add details estate Step [2] . */
    public function postAddDetailsEstate(Request $request)
    {
        $data = [];
        foreach ($request->features as $key => $value){
            if (isset($value)){
                $feature = Feature::with('type')->find($key);
                $data [] = [
                    'feature_id' => $key,
                    'type'       => $feature->type->type,
                    'value'      => $value,
                ];
            }
        }

        if (empty($data)){
            Alert::warning(trans('site.features_required'));
            return back();
        }

        $details_estate = [
            'features'    => json_encode($data),
            'additions'   => isset($request->additions)   ? implode(',',$request->additions) : null,
            'description' => isset($request->description) ? $request->description : null,
        ];

        Session::put('details_estate',$details_estate);
        Session::save();

        return redirect('estate-contacts');
    }

    /**  public function estate contacts . */
    public function estateContacts()
    {
        return view('site.estate.estate_contacts');
    }

    /**  public function estate_user_contacts Step [3]  . */
    public function postEstateContacts(EstateContacts $request)
    {
        $estate_contacts = [
            'phones'        => implode(',',$request->phones),
            'whatsapp'      => $request->whatsapp,
            'username'      => $request->username,
            'user_phone'    => $request->user_phone,
            'user_whatsapp' => $request->user_whatsapp,
        ];

        Session::put('estate_contacts',$estate_contacts);
        Session::save();

        return redirect('financial-obligations');
    }

    /**  public function financial_obligations . */
    public function financialObligations()
    {
        return view('site.estate.financial_obligations');
    }

    /**  public function confirm estate . */
    public function confirmEstate()
    {
        $add_estate      = Session::get('add_estate');
        $details_estate  = Session::get('details_estate');
        $estate_contacts = Session::get('estate_contacts');

        $addExcept = Arr::except($add_estate, ['images']);

        $addExcept['user_id']   = Auth::id();
        $addExcept['user_type'] = Auth::user()->user_type;

        $estate = Estate::create($addExcept);

        if (isset($add_estate['images'])){

            $images = $add_estate['images'];
            foreach ($images as $image){

                EstateImage::create([ "estate_id" =>$estate->id,"image"=> $image['image']]);
            }
        }

        $features = json_decode($details_estate['features'],true);

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

        if (isset($details_estate['additions'])){

            foreach (explode(',',$details_estate['additions']) as $addition){

                EstateAddition::updateOrCreate(
                    [ 'estate_id' => $estate->id , 'addition_id'=>$addition],
                    [
                       'addition_id' => $addition,
                    ]
                );
            }
        }

        if (isset($estate_contacts['phones'])){

            foreach (explode(',',$estate_contacts['phones']) as $phone){

                EstateContact::updateOrCreate(
                    ['estate_id' => $estate->id , 'phone'=>$phone] , ['phone' => $phone]
                );

                $data_phones [] = [$phone];
            }

            EstateContact::where(['estate_id'=>$estate->id])->whereNotIn('phone',$data_phones)->delete();
        }

        $estate->update([
            'description'   => $details_estate['description'],
            'whatsapp'      => $estate_contacts['whatsapp'],
            'username'      => $estate_contacts['username'],
            'user_phone'    => $estate_contacts['user_phone'],
            'user_whatsapp' => $estate_contacts['user_whatsapp'],
            'publish'       => 1,
        ]);

        return redirect('estate-published');
    }

    /**  public function estate published . */
    public function estatePublished()
    {
       return view('site.estate.estate_published');
    }

    /**  public function add_estate Step [1]  . */
    public function edit_estate(EditEstate $request)
    {
        $estate = Estate::where(['user_id'=> JWTAuth::toUser()->id,'id'=>$request->estate_id])->first();

        if (!isset($estate)){

            return $this->responseJsonData([],trans('apis.data_incorrect'));
        }

        $data = $this->EstateRepository->edit_estate($request->validated() , $estate);

        return $data;
    }

    /**  public function delete estate . */
    public function delete_estate(Request $request)
    {
        $estate = Estate::where(['id'=>$request->estate_id,'user_id'=>Auth::id()])->first();

        if (!isset($estate)){ abort(404);}

        $estate->delete();

        return back();
    }

}
