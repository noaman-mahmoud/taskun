<?php

namespace App\Http\Controllers\Api;
use App\Models\City;
use App\Models\Country;
use App\Traits\Responses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CityResource;
use App\Http\Resources\Api\CountryResource;
use App\Http\Resources\Api\CountryWithCitiesResource;

class CountryController extends Controller
{
    Use Responses ;

    public function countries()
    {
        $countries = CountryResource::collection(Country::latest()->get()) ;

        return $this->responseJsonData($countries);
    }

    public function cities(Request $request)
    {
        $cities = CityResource::collection(City::where('name', 'LIKE', '%' . $request->search . '%')->latest()->get()) ;

        return $this->responseJsonData($cities);
    }

    public function citiesByCountry($country_id)
    {
        $cities = CityResource::collection(City::where('country_id' , $country_id)->latest()->get()) ;

        return $this->responseJsonData($cities);
    }


    public function countriesWithCities()
    {
        $countries = CountryWithCitiesResource::collection(Country::latest()->get()) ;

        return $this->responseJsonData($countries);
    }
}
