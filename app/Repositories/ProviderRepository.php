<?php

namespace App\Repositories;
use Illuminate\Support\Arr;
use App\Traits\Responses;
use App\Models\Estate;
use App\Models\Category;
use App\Models\User;
use Validator;
use App;

class ProviderRepository
{
    use Responses;

    /**  public function providers. */
    public function providers($providers)
    {
        $data    = [];
        foreach ($providers as $provider){
            $data [] = [
                'id'       => $provider->id,
                'avatar'   => $provider->avatar,
                'name'     => $provider->name,
                'address'  => $provider->address,
                'lat'      => $provider->lat,
                'lng'      => $provider->lng,
                'distance' => (int)$provider->distance,
                'views'    => (int)$provider->views,
                'uuid'     => $provider->uuid,
                'count'    => Estate::where(['user_id'=>$provider->id,'archive'=>0])->count(),
            ];
        }

        return $data;
    }

    /**  public function provider details . */
    public function provider_details($provider)
    {
        $data_estates = [];

        foreach ($provider->estates->where('archive',0) as $estate){

            $data_estates [] = [
                'id'        => $estate->id,
                'image'     => isset($estate->estateImage) ? $estate->estateImage->image : '',
                'title'     => $estate->title,
                'address'   => $estate->address,
                'lat'       => $estate->lat,
                'lng'       => $estate->lng,
                'price'     => isset($estate->price) ? $estate->price : '',
                'sale_type' => trans('apis.'.$estate->sale_type),
                'type'      => trans('apis.'.$estate->type),
            ];
        }

        $data['id']            = $provider->id;
        $data['avatar']        = $provider->avatar;
        $data['name']          = $provider->name;
        $data['created']       = $provider->created_at->diffForHumans();
        $data['url']           = url('broker-details/' . $provider->uuid);
        $data['qr']            = $provider->qr;
        $data['uuid']          = $provider->uuid;
        $data['city']          = $provider->city->name;
        $data['address']       = $provider->address;
        $data['lat']           = $provider->lat;
        $data['lng']           = $provider->lng;
        $data['estates_count'] = $provider->estates_count;
        $data['views']         = (int)$provider->views;
        $data['phone']         = $provider->phone;
        $data['whatsapp']      = isset($provider->whatsapp) ? $provider->whatsapp : '';
        $data['estate_type']   = $this->convert_array_string($provider->estates);
        $data['estates']       = $data_estates;

        return $data;
    }

    public function convert_array_string($estates){

        $data_name = [];

        foreach ($estates as $estate){

            $data_name [] = [ Category::find($estate->category_id)->name];
        }

        $data = implode(', ', array_map(function ($entry) {
            return ($entry[key($entry)]);
        }, $data_name));

        return $data;
    }
}
