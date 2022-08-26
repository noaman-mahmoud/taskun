<?php

namespace App\Http\Requests\Api\Provider;
use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Validator;

class GetProvidersRequest extends BaseApiRequest
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
            'city_id' => 'nullable|exists:cities,id',
            'type'    => 'required|in:office,marketer',
            'lat'     => 'required',
            'lng'     => 'required',
            'search'  => 'nullable',
        ];
    }

    /**  public function messages . */
    public function messages()
    {
        return [
            'type.in' => 'type value [office] [marketer]',
        ];
    }

}
