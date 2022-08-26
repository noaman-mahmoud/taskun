<?php

namespace App\Http\Requests\Api\Management;
use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class AddProperty extends BaseApiRequest
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
            'name'               => 'required|min:2',
            'estate_type_id'     => 'required',
            'housing_type_id'    => 'required',
            'address'            => 'required',
            'lat'                => 'required',
            'lng'                => 'required',
            'number_roles'       => 'required|min:1',
        ];

    }
}
