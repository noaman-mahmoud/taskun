<?php

namespace App\Http\Requests\Admin\intros;

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
                'title_ar'                  => 'required',
                'title_en'                  => 'required',
                'description_ar'            => 'required',
                'description_en'            => 'required',
                'image'                     => ['nullable','image'],
            ];
            return $rules;
        }else{
            $rules = [
                'title_ar'                  => 'required',
                'title_en'                  => 'required',
                'description_ar'            => 'required',
                'description_en'            => 'required',
                'image'                     => ['required','image'],
            ];
            return $rules;
        }
    }
}
