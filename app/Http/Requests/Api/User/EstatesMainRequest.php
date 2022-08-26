<?php

namespace App\Http\Requests\Api\User;
use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class EstatesMainRequest extends BaseApiRequest
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
            'lat'     => 'required',
            'lng'     => 'required',
            'search'  => 'nullable',
        ];

    }
}
