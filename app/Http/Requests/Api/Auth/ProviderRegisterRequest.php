<?php

namespace App\Http\Requests\Api\Auth;
use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class ProviderRegisterRequest extends BaseApiRequest
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
            'email'          => 'required|email|min:5|unique:users,email',
            'password'       => 'required',
            'device_id'      => 'required',
            'device_type'    => 'required',
            'mac_address'    => 'required',
            'id_image'       => 'required',
            'id_number'      => 'required',
            'address'        => 'required',
            'lat'            => 'required',
            'lng'            => 'required',
            'city_id'        => 'required|exists:cities,id',
            'avatar'         => 'nullable',
        ];
    }
}
