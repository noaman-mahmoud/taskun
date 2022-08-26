<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends BaseApiRequest
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
            'name'           => 'required',
            'phone'          => 'required|min:9|unique:users,phone',
            'email'          => 'nullable|email|unique:users,email',
            'user_type'      => 'required|in:owner,office,marketer',
            'commercial'     => 'required_unless:user_type,owner',
            'advertiser_number' => 'required_unless:user_type,owner',
            'city_id'        => 'required_unless:user_type,owner|exists:cities,id',
            'address'        => 'required_unless:user_type,owner',
            'lat'            => 'required_unless:user_type,owner',
            'lng'            => 'required_unless:user_type,owner',
            'password'       => 'required|min:6',
            'device_id'      => 'required',
            'device_type'    => 'required',
            'mac_address'    => 'required',
            'uuid'           => 'nullable',
            'avatar'         => 'nullable',
        ];
    }

    /**  public function messages . */
    public function messages()
    {
        return [
            'user_type.in'  => 'type value [owner] [office] [marketer]',
            'commercial.required_unless' => awtTrans('السجل التجاري مطلوب'),
            'advertiser_number.required_unless' => awtTrans('رقم المعلن العقار مطلوب'),
        ];
    }
}
