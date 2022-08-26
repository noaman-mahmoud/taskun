<?php

namespace App\Http\Requests\Api\Estate;
use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class EstateContacts extends BaseApiRequest
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
        return  [
            'whatsapp'      => 'required|min:9',
            'phones'        => 'required',
            'phones*'       => 'required|min:9',
            'username'      => 'nullable',
            'user_phone'    => 'nullable',
            'user_whatsapp' => 'nullable',
        ];

    }

    /**  public function messages . */
    public function messages()
    {
        return [
        ];
    }
}
