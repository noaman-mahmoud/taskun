<?php

namespace App\Http\Requests\Api\Provider;
use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Validator;

class EditEstateRequest extends BaseApiRequest
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
            'estate_id'      => 'required|exists:estates,id',
            'image'          => 'nullable|image',
            'name_ar'        => 'nullable|min:4',
            'name_en'        => 'nullable|min:4',
            'price'          => 'nullable|numeric|min:1',
            'city_id'        => 'nullable|exists:cities,id',
            'address'        => 'nullable|min:4',
            'description_ar' => 'nullable|min:4',
            'description_en' => 'nullable|min:4',
            'lat'            => 'nullable|min:4',
            'lng'            => 'nullable|min:4',
            'features'       => 'nullable',
        ];


    }

}
