<?php

namespace App\Http\Requests\Api\Management;
use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class EditUnit extends BaseApiRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * `message`, `number_messages`
     */
    public function rules()
    {
        return  [
            'role'                => 'nullable',
            'name'                => 'nullable',
            'housing_type_id'     => 'nullable|exists:housing_types,id',
            'tenant_name'         => 'nullable:min:1||max:191',
            'contract_number'     => 'nullable|numeric|min:1',
            'phone'               => 'nullable:min:9||max:15',
            'whatsapp'            => 'nullable:min:9||max:15',
            'contract_from_date'  => 'nullable|date_format:Y-m-d',
            'contract_to_date'    => 'nullable|date_format:Y-m-d',
            'duration_contract'   => 'nullable|numeric|min:1',
            'rent'                => 'nullable',
            'payment_system'      => 'nullable',
            'electricity_bill'    => 'nullable',
            'water_bill'          => 'nullable',
            'message'             => 'nullable',
            'number_messages'     => 'nullable',
            'selected_date'       => 'nullable',
            'selected_dates'      => 'nullable',
        ];

    }
}
