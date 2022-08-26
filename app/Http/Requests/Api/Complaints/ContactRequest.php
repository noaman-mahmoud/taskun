<?php

namespace App\Http\Requests\Api\Complaints;
use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone'    => 'required|min:9' ,
            'email'    => 'required|email' ,
            'message'  => 'required|min:5' ,
        ];
    }
}
