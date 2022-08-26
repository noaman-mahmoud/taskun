<?php

namespace App\Http\Requests\Admin\tests;

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
                'image'                   => 'nullable|image',
                'name_ar'                 => 'required',
                'name_en'                 => 'required',
               
            ];
            return $rules;
        }else{
            $rules = [
                'image'                   => 'required|image',
                'name_ar'                 => 'required',
                'name_en'                 => 'required',
            ];
            return $rules;
        }
    }
}
