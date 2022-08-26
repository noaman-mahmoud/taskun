<?php

namespace App\Repositories;
use Illuminate\Support\Arr;
use App\Models\RealProperty;
use App\Models\HousingType;
use App\Models\EstateType;
use App\Traits\Responses;
use Carbon\CarbonPeriod;
use App\Models\UnitDate;
use Carbon\Carbon;
use App;
use DB;

class ManagementRepository
{
    use Responses;

    /**  public function properties . */
    public function properties($properties)
    {
        $data = [];
        foreach ($properties as $property){

            $data [] = [
                'id'      => $property->id,
                'image'   => url('storage/images/settings/property_image.png'),
                'name'    => $property->name,
                'address' => $property->address,
                'units'   => $property->units_count,
            ];
        }

        return $data;
    }

    /**  public function property_details . */
    public function property_details($property)
    {
        $data_units = [];
        foreach ($property->units as $unit){
            $date = UnitDate::where('unit_id',$unit->id)->max('date');
            $data_units [] = [
                'id'          => $unit->id,
                'role'        => (int)$unit->role,
                'archive'     => (int)$unit->archive,
                'name'        => $unit->name ?? "",
                'tenant_name' => $unit->tenant_name,
                'date'        => Carbon::parse($date)->addMonths()->format('Y-m-d'),
            ];
        }

        $data['id']              = $property->id;
        $data['image']           = url('storage/images/settings/property_image.png');
        $data['name']            = $property->name;
        $data['estate_type_id']  = (int)$property->estate_type_id;
        $data['estate_type']     = $property->estateType->name;
        $data['address']         = $property->address;
        $data['lat']             = $property->lat;
        $data['lng']             = $property->lng;
        $data['number_roles']    = (int)$property->number_roles;
        $data['housingType']     = $property->housingType->name;
        $data['housing_type_id'] = (int)$property->housing_type_id;
        $data['units_count']     = isset($property->units_count) ? $property->units_count : 0;
        $data['units']           = array_reverse($data_units);

        return $data;
    }

    /**  public function edit property . */
    public function edit_property($requests , $property)
    {
        $result = array_filter($requests);

        empty($requests) ? $result : $property->update($result);

        return Arr::except($this->property_details($property),['units_count','units']);
    }

    /**  public function unit details . */
    public function unit_details($unit)
    {
        $results = CarbonPeriod::create($unit->contract_from_date,'1 month',$unit->contract_to_date);
        $dates   = [];

        foreach ($results as $key => $result) {

            $checked  = UnitDate::where(['unit_id'=>$unit->id,'date'=>$result->format("Y-m-d")])->first();
            $dates [] = [
                'id'      => ++$key,
                'date'    => $result->translatedFormat("d F Y"),
                'select'  => $result->format("Y-m-d"),
                'checked' => isset($checked) ? 1 : 0
            ];

            $parseDate = Carbon::parse($result);

            if (Carbon::now()->format('Y-m') == $parseDate->format('Y-m')){

                $nextDate  = $parseDate->addMonth()->format('Y-m-d');
            }
        }

        $data['id']                 = $unit->id;
        $data['role']               = $unit->role;
        $data['name']               = $unit->name ?? "";
        $data['tenant_name']        = $unit->tenant_name;
        $data['contract_number']    = $unit->contract_number;
        $data['phone']              = $unit->phone;
        $data['whatsapp']           = $unit->whatsapp;
        $data['contract_from_date'] = $unit->contract_from_date;
        $data['contract_to_date']   = $unit->contract_to_date;
        $data['duration_contract']  = $unit->duration_contract;
        $data['rent']               = $unit->rent;
        $data['payment_system']     = $unit->payment_system;
        $data['housing_type']       = $unit->housingType->name;
        $data['housing_type_id']    = $unit->housing_type_id;
        $data['electricity_bill']   = $unit->electricity_bill;
        $data['water_bill']         = $unit->water_bill;
        $data['message']            = isset($unit->message) ? $unit->message : '';
        $data['number_messages']    = isset($unit->number_messages) ? (int)$unit->number_messages : 0;
        $data['next_date']          = isset($nextDate) ? $nextDate : '';
        $data['dates']              = $dates;

        return $data;
    }

    /**  public function edit unit . */
    public function edit_unit($requests , $unit)
    {
        $dataExcept = Arr::except($requests, ['selected_date','selected_dates']);

        if (isset($requests['selected_date'])){

            UnitDate::updateOrCreate(
                ['date' => $requests['selected_date'], 'unit_id' => $unit->id],
                ['date' => $requests['selected_date'], 'unit_id' => $unit->id]
            );
        }

        if (isset($requests['selected_dates'])){

            foreach ($requests['selected_dates'] as $date){

                UnitDate::updateOrCreate(
                    ['date' => $date, 'unit_id' => $unit->id],
                    ['date' => $date, 'unit_id' => $unit->id]
                );
            }

        }

        $result = array_filter($dataExcept);

        empty($requests) ? $result : $unit->update($result);

        return $this->unit_details($unit);
    }

}
