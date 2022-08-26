<?php

namespace App\Http\Requests\Admin\countries;

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
            return [
                'name_ar'                => 'required|max:191',
                'name_en'                => 'required|max:191',
                'key'                    => 'required|unique:countries,key,'.$this->id,
            ];
        }else{
            return [
                'name_ar'                => 'required|max:191',
                'name_en'                => 'required|max:191',
                'key'                 => 'required|unique:countries,key',
            ];
        }
       
    }
}
