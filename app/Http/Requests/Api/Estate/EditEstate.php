<?php

namespace App\Http\Requests\Api\Estate;
use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Validator;

class EditEstate extends BaseApiRequest
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
            'estate_id'          => 'required|exists:estates,id',
            'type'               => 'nullable|in:sell,rent',
            'city_id'            => 'nullable|exists:cities,id',
            'address'            => 'nullable',
            'lat'                => 'nullable',
            'lng'                => 'nullable',
            'category_id'        => 'nullable|exists:categories,id',
            'title'              => 'nullable',
            'estate_category_id' => 'nullable|exists:estate_categories,id',
            'entrustment'        => 'nullable',
            'sale_type'          => 'nullable|in:som,limit',
            'price'              => 'required_if:sale_type,==,limit|numeric|min:1',
            'neighborhood'       => 'nullable',
            'planned'            => 'nullable',
            'delete_images'      => 'nullable',
            'features'           => 'nullable',
            'additions'          => 'nullable',
            'description'        => 'nullable',
            'whatsapp'           => 'nullable',
            'phones'             => 'nullable',
            'username'           => 'nullable',
            'user_phone'         => 'nullable',
            'user_whatsapp'      => 'nullable',
            "images"             => "nullable|array",
            'images.*'           => 'nullable',
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
