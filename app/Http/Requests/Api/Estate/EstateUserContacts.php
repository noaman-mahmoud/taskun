<?php

namespace App\Http\Requests\Api\Estate;
use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class EstateUserContacts extends BaseApiRequest
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
            'estate_id'     => 'required|exists:estates,id',
            'whatsapp'      => 'required',
            'phones'        => 'required',
            'username'      => 'nullable',
            'user_phone'    => 'nullable',
            'user_whatsapp' => 'nullable',
        ];

    }

}
