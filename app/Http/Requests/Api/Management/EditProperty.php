<?php

namespace App\Http\Requests\Api\Management;
use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class EditProperty extends BaseApiRequest
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
            'name'               => 'nullable|min:2',
            'estate_type_id'     => 'nullable|exists:estate_types,id',
            'housing_type_id'    => 'nullable|exists:housing_types,id',
            'address'            => 'nullable',
            'lat'                => 'nullable',
            'lng'                => 'nullable',
            'number_roles'       => 'nullable|numeric|min:1',
        ];

    }
}
