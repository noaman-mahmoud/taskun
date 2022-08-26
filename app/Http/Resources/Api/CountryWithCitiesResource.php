<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryWithCitiesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'   => (int) $this->id , 
            'name' => (string) $this->name , 
            'key'  => (string) $this->key ,
            'cities' => $this->cities->map(function ($city){
                return [
                    'id'          => (int) $city->id , 
                    'name'        => (string) $city->name , 
                    'country_id'  => (int) $city->country_id , 
                ];
            }) ,
        ];
    }
}
