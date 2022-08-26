<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountTypeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => (int) $this->id ,
            'type'        => (string) $this->type,
            'name'        => $this->name,
            'account'     => $this->account,
            'description' => $this->description,
        ];
    }
}
