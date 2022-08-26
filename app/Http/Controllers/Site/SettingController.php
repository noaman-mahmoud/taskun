<?php

namespace App\Http\Controllers\Site;
use App\Http\Requests\Api\addTransferRequest;
use App\Http\Requests\Api\Complaints\StoreComplaintRequest;
use App\Http\Resources\Api\SocialResource;
use App\Http\Resources\Api\ImageResource;
use App\Http\Resources\BankResource;
use App\Http\Controllers\Controller;
use App\Services\SettingService;
use App\Models\EstateCategory;
use App\Models\SiteSetting;
use App\Models\Complaint;
use App\Models\Category;
use App\Models\Social;
use App\Models\Bank;
use App;


class SettingController extends Controller
{
    public function about()
    {
        $data = SiteSetting::where(['key' => 'about_'.lang()])->first()->value ;

        return view('site.about',compact('data'));
    }

    public function policy()
    {
        $data = SiteSetting::where(['key' => 'privacy_'.lang()])->first()->value ;

        return view('site.policy',compact('data'));
    }

    public function terms()
    {
        $data = SiteSetting::where(['key' => 'terms_'.lang()])->first()->value ;

        return view('site.terms',compact('data'));
    }

    /**  public function contact us . */
    public function contactUs()
    {
        $data['phone']     = SiteSetting::where(['key' => 'phone'])->first()->value;
        $data['email']     = SiteSetting::where(['key' => 'email'])->first()->value;
        $data['whatsapp']  = SiteSetting::where(['key' => 'whatsapp'])->first()->value;
        $data['socials']   = SocialResource::collection(Social::latest()->get());

        return view('site.contact_us' , get_defined_vars());
    }

    /** site public function bank_accounts . */
    public function bankAccounts()
    {
        $banks = Bank::select('bank_name','account_name','account_number','iban_number','image')->get();

        return view('site.bank_accounts', get_defined_vars());
    }

}

