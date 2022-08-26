<?php

namespace App\Http\Requests\Admin\banks;

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
                'bank_name'      => 'required|max:191',
                'account_name'   => 'required|max:191',
                'account_number' => 'required|max:191',
                'iban_number'    => 'required|max:191',
                'image'          => ['nullable','image'],
            ];
            return $rules;
        }else{
            $rules = [
                'bank_name'      => 'required|max:191',
                'account_name'   => 'required|max:191',
                'account_number' => 'required|max:191',
                'iban_number'    => 'required|max:191',
                'image'    => ['required','image'],
            ];
            return $rules;
        }
    }
}
