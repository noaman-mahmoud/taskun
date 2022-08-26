<?php

namespace App\Http\Requests\Api\User;
use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class BankTransfers extends BaseApiRequest
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
            'name'            => 'required|min:3',
            'account_owner'   => 'required|min:3',
            'account_number'  => 'required|min:10',
            'amount'          => 'required|min:1',
            'image'           => 'nullable|image',
            'type'            => 'nullable',
        ];

    }

    /**  public function messages . */
    public function messages()
    {
        return [
            'account_owner.min'=> awtTrans('يجب الا يقل اسم الحساب عن 3 احرف')
        ];
    }
}
