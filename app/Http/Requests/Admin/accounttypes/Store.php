<?php

namespace App\Http\Requests\Admin\accounttypes;

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
                'name_ar'        => 'nullable|max:191',
                'name_en'        => 'nullable|max:191',
                'account_ar'     => 'required|max:191',
                'account_en'     => 'required|max:191',
                'description_ar' => 'nullable',
                'description_en' => 'nullable',
            ];
            return $rules;
        }else{
            $rules = [
                'name_ar'        => 'nullable|max:191',
                'name_en'        => 'nullable|max:191',
                'account_ar'     => 'required|max:191',
                'account_en'     => 'required|max:191',
                'description_ar' => 'required',
                'description_en' => 'required',
            ];
            return $rules;
        }
    }
}
