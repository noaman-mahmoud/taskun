<?php

namespace App\Http\Requests\Admin\features;

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
                'name_ar' => 'required|max:191',
                'name_en' => 'required|max:191',
                'type_id' => 'required',
                'image'   => ['nullable','image'],
            ];
            return $rules;
        }else{
            $rules = [
                'name_ar' => 'required|max:191',
                'name_en' => 'required|max:191',
                'type_id' => 'required',
                'image'   => ['required','image'],
            ];
            return $rules;
        }
    }
}
