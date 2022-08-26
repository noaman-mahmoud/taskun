<?php

namespace App\Http\Requests\Api\Provider;
use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class AddEstateRequest extends BaseApiRequest
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
            'image'          => 'required|image',
            'name_ar'        => 'required',
            'name_en'        => 'required',
            'price'          => 'required|numeric|min:1',
            'city_id'        => 'required|exists:cities,id',
            'address'        => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'lat'            => 'required',
            'lng'            => 'required',
            'features'       => 'required',
        ];

    }
}
