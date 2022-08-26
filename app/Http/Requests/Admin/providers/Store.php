<?php

namespace App\Http\Requests\Admin\providers;

use Illuminate\Foundation\Http\FormRequest;

class store extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        if($this->getMethod() === 'PUT'){
            $rules = [
                'name'           => 'required',
                'phone'          => 'required|min:10|numeric|unique:users,phone,'.$this->id,
                'email'          => 'required|email|max:191|unique:users,email,'.$this->id,
                'password'       => 'nullable',
                'id_image'       => 'nullable',
                'id_number'      => 'required',
                'address'        => 'nullable',
                'lat'            => 'nullable',
                'lng'            => 'nullable',
                'city_id'        => 'nullable|exists:cities,id',
                'avatar'         => 'nullable',
                'activation_admin'  => 'required',
            ];
            return $rules;
        }else{
            $rules = [
                'name'           => 'required',
                'phone'          => 'required|numeric|min:10|unique:users,phone',
                'email'          => 'required|email|min:5|unique:users,email',
                'password'       => 'required',
                'id_image'       => 'required',
                'id_number'      => 'required',
                'address'        => 'required',
                'lat'            => 'required',
                'lng'            => 'required',
                'city_id'        => 'required|exists:cities,id',
                'avatar'         => 'nullable',
            ];
            return $rules;
        }
    }
}
