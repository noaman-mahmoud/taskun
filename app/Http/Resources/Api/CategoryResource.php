<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'id'            => (int) $this->id ,
            'name'          => (string) $this->name ,
//            'image'         => (string) $this->image ,
            'parent_id'     => $this->when($this->parent_id , $this->parent_id),
            'parent_name'   => $this->when($this->parent_id , $this->parent->name ?? ''),
        ];
    }
}
