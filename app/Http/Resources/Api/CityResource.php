<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'    => (int) $this->id ,
            'name'  => (string) $this->name ,
            'lat'   => (string) $this->lat ,
            'lng'   => (string) $this->lng ,
        ];
    }
}
