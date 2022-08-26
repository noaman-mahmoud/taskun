<?php

namespace App\Http\Requests\Api\Estate;
use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Validator;

class SearchEstatesProvider extends BaseApiRequest
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
            'provider_id'        => 'required|exists:users,id',
            'city_id'            => 'nullable|exists:cities,id',
            'lat'                => 'required',
            'lng'                => 'required',
            'type'               => 'required|in:sell,rent',
            'search'             => 'nullable',
            'sale_type'          => 'nullable|in:som,limit',
            'category_id'        => 'nullable|exists:categories,id',
            'estate_category_id' => 'required|exists:estate_categories,id',
        ];
    }

    /**  public function messages . */
    public function messages()
    {
        return [
            'type.in'            => 'type value [sell] [rent]',
            'sale_type.in'       => 'type value [som] [limit]',
        ];
    }
}
