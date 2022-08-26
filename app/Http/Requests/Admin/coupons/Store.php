<?php

namespace App\Http\Requests\Admin\coupons;

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
                'identity'              => 'required|unique:coupons,identity,'.$this->id,
                'usage'                 => 'required|numeric',
                'discount'              => 'required|numeric',
                'max_discount'          => 'required|numeric',
                'expire_date'           => 'required|after_or_equal:'.\Carbon\Carbon::now(),
                'type'                  => 'required|in:ratio,number',
            ];
            return $rules;
        }else{
            $rules = [
                'identity'              => 'required|unique:coupons,identity',
                'usage'                 => 'required|numeric',
                'discount'              => 'required|numeric',
                'max_discount'          => 'required|numeric',
                'expire_date'           => 'required|after_or_equal:'.\Carbon\Carbon::now(),
                'type'                  => 'required|in:ratio,number',
            ];
            return $rules;
        }
    }
}
