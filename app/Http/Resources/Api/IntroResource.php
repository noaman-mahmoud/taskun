<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class IntroResource extends JsonResource
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
            'id'                => (int) $this->id ,
            'title'             => (string) $this->title ,
            'description'       => (string) $this->description ,
            'image'             => (string) $this->image ,
        ];
    }
}
