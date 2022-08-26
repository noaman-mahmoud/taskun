<?php

namespace App\Http\Requests\Api\User;
use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends BaseApiRequest
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
            'estate_id'   => 'required|exists:estates,id',
            'first_name'  => 'required|min:3',
            'father_name' => 'required|min:3',
            'last_name'   => 'required|min:3',
            'phone'       => 'required|min:3',
            'id_number'   => 'required|min:3',
            'start_date'  => 'required|date_format:Y-m-d|after:today',
            'start_time'  => 'required',
            'end_date'    => 'required|date_format:Y-m-d',
            'end_time'    => 'required',
        ];
    }
}
