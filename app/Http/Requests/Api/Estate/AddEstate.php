<?php

namespace App\Http\Requests\Api\Estate;
use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class AddEstate extends BaseApiRequest
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
            'type'               => 'required|in:sell,rent',
            'city_id'            => 'required',
            'address'            => 'required',
            'lat'                => 'required',
            'lng'                => 'required',
            'category_id'        => 'required',
            'title'              => 'required',
            'estate_category_id' => 'required',
            'entrustment'        => 'nullable',
            'sale_type'          => 'required|in:som,limit',
            'price'              => 'required_if:sale_type,==,limit',
            'neighborhood'       => 'required',
            'planned'            => 'nullable',
            "images"             => "nullable|array",
            'images.*'           => 'required',
        ];

    }

    /**  public function messages . */
    public function messages()
    {
        return [
            'type.in'      => 'type value [sell] [rent]',
            'sale_type.in' => 'type value [som] [limit]',
        ];
    }
}
