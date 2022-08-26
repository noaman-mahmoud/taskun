<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Complaints\ContactRequest;
use App\Repositories\ProviderRepository;
use App\Repositories\EstateRepository;
use App\Models\EstateCategory;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Arr;
use App\Models\Complaint;
use App\Models\Category;
use App\Models\Addition;
use Carbon\CarbonPeriod;
use App\Models\Feature;
use App\Models\Option;
use App\Models\Estate;
use App\Models\User;
use App\Models\City;
use Session;
use Route;
use Alert;

class SiteController extends Controller {

    private $EstateRepository , $ProviderRepository;

    public function __construct(EstateRepository $EstateRepository,ProviderRepository $ProviderRepository)
    {
        $this->EstateRepository   = $EstateRepository;
        $this->ProviderRepository = $ProviderRepository;
    }

    public function language($lang)
    {
        Session()->has('language') ? Session()->forget('language') : '';

        isset($lang) ? Session()->put('language', $lang) :  Session()->put('language', 'ar');

        return back();
    }

    /**  public function index . */
    public function index()
    {
        $estateCategories = EstateCategory::get();
        $categories       = Category::get();

        $estates    = Estate::with(['likes','estateImage'])->where(['publish'=>1])->latest()->take(6);
        $shows      = $this->EstateRepository->estates($estates->where('user_type','owner')->get());


        $data       = ['active'=> 1 ,'block'=> 0];
        $offices    = User::where(Arr::add($data, 'user_type', 'office'))->latest()->take(6);
        $marketers  = User::where(Arr::add($data, 'user_type', 'marketer'))->latest()->take(6);

        $offices   = $this->ProviderRepository->providers($offices->get());
        $marketers = $this->ProviderRepository->providers($marketers->get());

        return view('site.index' , get_defined_vars());
    }

    /**  public function post_search . */
    public function postSearch(Request $request)
    {
        $query   = Estate::with(['likes'])->where(['publish'=>1])->newQuery();

        if (isset($request['category_id'])){

            $query->where('category_id',$request['category_id']);
        }

        if (isset($request['estate_category_id'])){

            $query->where('estate_category_id',$request['estate_category_id']);
        }

        if (isset($request['address'])){

            $query->where('address', 'LIKE', '%' . $request['address'] . '%');
        }

        $estates = $this->EstateRepository->estates($query->get());

        Session::put('estates', $estates);

        return redirect('search');
    }

    /**  public function search . */
    public function search()
    {
        $estates = Session::get('estates');

        return view('site.search', compact('estates'));
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

    /**  public function live shows . */
    public function filters_data()
    {
        $period = CarbonPeriod::create(now()->subYears(5) ,now() );
        $dates  = [];
        $keys   = [];

        foreach ($period as $date) {
            if (!in_array($date->format('Y'), $keys)) {
                $keys  [] = $date->format('Y');
                $dates [] = ['date' => $date->format('Y') ];
            }
        }

        $years      = $dates;
        $features   = $this->features();
        $estateCate = EstateCategory::get();
        $additions  = Addition::latest()->get();
        $categories = Category::get();
        $cities     = City::get();

        return get_defined_vars();

    }

    /**  public function live shows . */
    public function liveShows()
    {
        $estates = Estate::with(['likes','estateImage'])->where(['user_type'=>'owner','publish'=>1])
            ->latest()->paginate(9);

        Session::forget('broker');

        return view('site.live_shows',$this->filters_data(),compact('estates'));
    }

    /**  public function filters . */
    public function filters()
    {
        $estates = Session::get('estates_filter');
        $data    = Session::get('broker');
        $broker  = User::find($data);

        return view('site.live_shows',$this->filters_data(),compact('estates','broker'));
    }

    /**  public function estates search . */
    public function estatesSearch(Request $request)
    {
        if (isset($request->broker)){

            $broker = $request->broker;
            $query  = Estate::with(['likes'])->where(['user_id'=>$broker,'publish'=>1,'archive'=>0])->newQuery();
            Session::put('broker',$broker);

        }else{

            $query  = Estate::with(['likes'])->where(['user_type'=>'owner','publish'=>1])->newQuery();
        }

        $query   = $this->EstateRepository->estates_filter($request->all() ,$query);

        $estates = $query->with(['likes','estateImage'])->latest()->paginate(9);

        Session::put('estates_filter',$estates);

        return redirect('filters');
    }

    /**  public function estates filter . */
    public function estatesFilter(Request $request)
    {
        $requests = Arr::except($request->all(), ['price','features','additions']);

        ## convert price explode separator
        if (isset($request->price)){
            $price = explode(';', $request->price);
            $requests['price_from'] =  $price[0];
            $requests['price_to']   =  $price[1];
        }

        ## convert features to json encode
        if (isset($request->features)){
            $data = [];
            foreach ($request->features as $key => $value){

                if (isset($value) && $value > 0){

                    $feature = Feature::with('type')->find($key);
                    $Value_  = explode(';', $value);

                    if (array_key_exists(1 ,$Value_)){
                        $data [] = [
                            'feature_id' => $key,
                            'type'       => $feature->type->type,
                            'value'      => $Value_[0],
                            'from'       => $Value_[1],
                        ];
                    }else{
                        $data [] = [
                            'feature_id' => $key,
                            'type'       => $feature->type->type,
                            'value'      => $Value_[0],
                        ];
                    }
                }
            }

            $requests['features'] = !empty($data) ? json_encode($data) : null;
        }

        ## convert additions and implode separator
        if (isset($request->additions)){

            $requests['additions'] = implode(',',$request->additions);
        }

        if (isset($request->broker)){

            $broker = $request->broker;
            $query  = Estate::with(['likes'])->where(['user_id'=>$broker,'publish'=>1,'archive'=>0])->newQuery();
            Session::put('broker',$broker);
        }else{

            $query  = Estate::with(['likes'])->where(['user_type'=>'owner','publish'=>1])->newQuery();
        }

        $query   = $this->EstateRepository->estates_filter($requests ,$query);

        $estates = $query->with(['likes','estateImage'])->latest()->paginate(9);

        Session::put('estates_filter',$estates);

        return redirect('filters');
    }

    /**  public function details_estate . */
    public function estateDetails($id)
    {
        $Estate  = Estate::findOrFail($id);

        $estate  = $this->EstateRepository->estate_details($Estate);
        $estates = Estate::where(['user_id'=>$Estate->user_id,'publish'=>1])
                        ->with(['likes','estateImage'])->latest()->get();

        $Estate->increment('views');

        return view('site.estate_details',get_defined_vars());
    }

    /**  public function brokers . */
    public function brokers()
    {
        $requests  = ['active'=>1 ,'block'=>0];

        $offices   = User::where($requests)->where(['user_type'=>'office'])
            ->withCount('estates')->latest()->paginate(9);

        $marketers = User::where($requests)->where(['user_type'=>'marketer'])
            ->withCount('estates')->latest()->paginate(9);

        $cities     = City::get();

        return view('site.brokers',get_defined_vars());
    }

    /**  public function broker_details . */
    public function brokerDetails($uuid)
    {
        $broker = User::withCount(['estates'=> function($query){
            $query->where('archive', 0);

        }])->with(['estates'])->where('uuid',$uuid)->first();

        if (!isset($broker)) abort('404');

        $data   = $this->ProviderRepository->provider_details($broker);

        return view('site.broker_details',get_defined_vars());
    }

    /**  public function broker_estates . */
    public function brokerEstates($uuid)
    {
        $broker  = User::where('uuid',$uuid)->first();

        if (!isset($broker)) abort('404');

        $estates = Estate::where(['user_id'=>$broker->id,'archive'=>0,'publish'=>1])
            ->with('likes')->latest()->paginate(9);

        return view('site.live_shows',compact('estates','broker'),$this->filters_data());
    }

    /**  public function commission calculator . */
    public function commissionCalculator()
    {
        $data = (int) SiteSetting::where(['key' => 'commission'])->first()->value;
        $type = 'commission';
        
        return view('site.commission_calculator', get_defined_vars());
    }

    /**  public function quest calculator . */
    public function questCalculator()
    {
        $data = (int) SiteSetting::where(['key' => 'pursuit'])->first()->value;
        $type = 'pursuit';
        
        return view('site.commission_calculator', get_defined_vars());
    }

    /**  public function contact . */
    public function contact(ContactRequest $request)
    {
        $dataExcept = Arr::except($request->validated(), ['message']);
        $dataExcept['complaint'] = $request->message;

        Complaint::create($dataExcept);

        Alert::success(trans('apis.send_contact'));

        return redirect('/');
    }
}
