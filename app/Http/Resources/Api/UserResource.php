<?php

namespace App\Http\Resources\Api;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use JWTAuth;
class UserResource extends JsonResource
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
            'avatar'            => (string)    $this->avatar,
            'name'              => (string)    $this->name,
            'phone'             => (string)    $this->phone,
            'user_type'         => $this->user_type,
            'user_type_name'    => trans('apis.'.$this->user_type),
            'commercial'        => isset($this->commercial)        ?  $this->commercial   : '',
            'advertiser_number' => isset($this->advertiser_number) ?  $this->advertiser_number : '',
            'email'             => isset($this->email)             ?  $this->email   : '',
            'lat'               => isset($this->lat)               ?  $this->lat     : '',
            'lng'               => isset($this->lng)               ?  $this->lng     : '',
            'address'           => isset($this->address)           ?  $this->address : '',
            'qr'                => isset($this->qr)                ?  $this->qr      : '',
            'block'             => (int)    $this->block,
            'active'            => (int)    $this->active,
            'lang'              => (string) $this->lang,
            'is_notify'         => (int)    $this->is_notify ,
            'activation_admin'  => (int)    $this->activation_admin,
            'token'             => (string) $this->jwt_token,
        ];
    }
}
