<?php

namespace App\Http\Requests\Api\Management;
use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class AddUnit extends BaseApiRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     *
     */
    public function rules()
    {
        return  [
            'property_id'         => 'required|exists:real_properties,id',
            'role'                => 'required',
            'name'                => 'required',
            'housing_type_id'     => 'required|exists:housing_types,id',
            'tenant_name'         => 'required:min:1||max:191',
            'contract_number'     => 'required|numeric|min:1',
            'phone'               => 'required:min:9||max:15',
            'whatsapp'            => 'required:min:9||max:15',
            'contract_from_date'  => 'required|date_format:Y-m-d',
            'contract_to_date'    => 'required|date_format:Y-m-d|after:contract_from_date',
            'duration_contract'   => 'required|min:1',
            'rent'                => 'required',
            'payment_system'      => 'required',
            'electricity_bill'    => 'nullable',
            'water_bill'          => 'nullable',
            'message'             => 'nullable',
            'number_messages'     => 'nullable',
        ];
    }

    /**  public function message . */
    public function messages()
    {
        return [
            'tenant_name.required'        => awtTrans('أسم المستأجر'),
            'contract_number.required'    => awtTrans('رقم العقد'),
            'contract_from_date.required' => awtTrans('بدايه العقد'),
            'contract_to_date.required'   => awtTrans('نهايه العقد'),
            'duration_contract.required'  => awtTrans('مده العقد'),
            'rent.required'               => awtTrans('قيمه الأيجار'),
            'payment_system.required'     => awtTrans('نظام الدفع'),
            'contract_to_date.after'      => awtTrans('يجب ان يكون تاريخ النهايه بعد تاريخ البدايه'),
        ];
    }
}
