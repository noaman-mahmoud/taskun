<?php

namespace App\Http\Requests\Admin\housingtypes;

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
                'estate_type_id'   => 'required',
            ];
            return $rules;
        }else{
            $rules = [
                'name_ar' => 'required|max:191',
                'name_en' => 'required|max:191',
                'estate_type_id' => "required",
            ];
            return $rules;
        }
    }
}
