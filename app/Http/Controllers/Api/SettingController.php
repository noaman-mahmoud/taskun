<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\Api\addTransferRequest;
use App\Http\Requests\Api\Complaints\StoreComplaintRequest;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\Api\AdditionResource;
use App\Repositories\Interfaces\ITransfer;
use App\Http\Resources\Api\SocialResource;
use App\Http\Resources\Api\ImageResource;
use App\Repositories\Interfaces\ISetting;
use App\Http\Resources\Api\IntroResource;
use App\Repositories\Interfaces\IBank;
use App\Http\Resources\Api\FqsResource;
use App\Http\Resources\BankResource;
use App\Http\Controllers\Controller;
use App\Services\SettingService;
use App\Models\EstateCategory;
use Illuminate\Support\Arr;
use App\Models\SiteSetting;
use App\Models\Complaint;
use App\Traits\Responses;
use App\Models\Category;
use App\Models\Social;
use App\Models\Addition;
use App\Models\Feature;
use App\Models\Image;
use App\Models\Intro;
use App\Models\Bank;
use App\Models\Fqs;
use App;


class SettingController extends Controller
{
    use Responses;

    public function categories($id = null )
    {
        $data = CategoryResource::collection(Category::where('parent_id' , $id)->latest()->get()) ;

        return $this->responseJsonData($data);
    }

    public function estate_categories()
    {
        $data = CategoryResource::collection(EstateCategory::latest()->get()) ;

        return $this->responseJsonData($data);
    }

    public function additions()
    {
        $data = AdditionResource::collection(Addition::latest()->get()) ;

        return $this->responseJsonData($data);
    }

    public function settings()
    {
        $data =  SettingService::appInformations(SiteSetting::pluck('value', 'key'));

        return $this->responseJsonData($data);
    }

    public function about()
    {
        $data = SiteSetting::where(['key' => 'about_'.lang()])->first()->value ;

        return $this->responseJsonData($data);
    }

    public function terms()
    {
        $data = SiteSetting::where(['key' => 'terms_'.lang()])->first()->value;

        return $this->responseJsonData($data);
    }

    public function privacy()
    {
        $data = SiteSetting::where(['key' => 'privacy_'.lang()])->first()->value ;

        return $this->responseJsonData($data);
    }

    public function management_fees()
    {
        $data = SiteSetting::where(['key' => 'management_fees_'.lang()])->first()->value ;

        return $this->responseJsonData($data);
    }

    public function complaint(StoreComplaintRequest $request)
    {

        $dataExcept = Arr::except($request->validated(), ['message']);
        $dataExcept['complaint'] = $request->message;
        $dataExcept['user_name'] = $request->name;

        Complaint::create($dataExcept);

        return $this->responseJsonData([],trans('apis.messageSended'));
    }

    public function connect_us()
    {
        $data['phone']     = SiteSetting::where(['key' => 'phone'])->first()->value;
        $data['email']     = SiteSetting::where(['key' => 'email'])->first()->value;
        $data['whatsapp']  = SiteSetting::where(['key' => 'whatsapp'])->first()->value;
        $data['socials']   = SocialResource::collection(Social::latest()->get());

        return $this->responseJsonData($data);
    }

    public function fqss()
    {
        $fqss = FqsResource::collection(Fqs::latest()->get()) ;
        return $this->response('success' , '' , $fqss);
    }

    public function intros()
    {
        $intros = IntroResource::collection(Intro::latest()->get()) ;
        return $this->responseJsonData($intros);
    }

    public function socials()
    {
        $socials = SocialResource::collection(Social::latest()->get()) ;
        return $this->response('success' , '' , $socials);
    }

    public function features()
    {
        $data = Feature::select('id','name->'. App::getLocale() . ' as name','image')->get();

        return $this->responseJsonData($data);
    }

    public function images($id = null )
    {
        $images = ImageResource::collection(Image::latest()->get()) ;

        return $this->response('success' , '' , $images);
    }

    /**  public function calculator . */
    public function calculator()
    {
        $data['commission'] = (int) SiteSetting::where(['key' => 'commission'])->first()->value;
        $data['pursuit']    = (int) SiteSetting::where(['key' => 'pursuit'])->first()->value;

        return $this->responseJsonData($data);
    }

    /**  public function bank_accounts . */
    public function bank_accounts()
    {
        $banks = Bank::select('bank_name','account_name','account_number','iban_number','image')->get();

        return $this->responseJsonData($banks);
    }
}

