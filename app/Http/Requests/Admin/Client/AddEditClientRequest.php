<?php

namespace App\Http\Requests\Admin\Client;

use Illuminate\Foundation\Http\FormRequest;

class AddEditClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if($this->getMethod() === 'PUT'){
            $rules = [
                'name'                  => 'required|max:191',
                'block'                 => 'required',
                'phone'                 => 'required|min:9|numeric|unique:users,phone,'.$this->id,
                'email'                 => 'nullable|email|max:191|unique:users,email,'.$this->id,
                'city_id'               => 'nullable',
                'address'               => 'nullable',
                'lat'                   => 'nullable',
                'lng'                   => 'nullable',
                'password'              => ['nullable','min:6'],
                'avatar'                => ['nullable','image'],
            ];
            return $rules;
        }else{
            $rules = [
                'name'                  => 'required|max:191',
                'block'                 => 'required',
                'phone'                 => 'required|min:10|unique:users,phone,NULL,NULL,deleted_at,NULL',
                'email'                 => 'required|email|max:191|unique:users,email,NULL,NULL,deleted_at,NULL',
                'password'              => ['required','min:6'],
                'avatar'                => ['nullable','image'],
            ];
            return $rules;
        }
    }
}
