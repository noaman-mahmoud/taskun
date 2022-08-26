<?php

namespace App\Http\Requests\Admin\images;

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
                'image'                => ['nullable','image'],
            ];
            return $rules;
        }else{
            $rules = [
                'image'                => ['required','image'],
            ];
            return $rules;
        }
    }
}
