<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class HousingUnit extends Model
{
    protected $table    = "housing_units";
    protected $casts    = ['contract_to_date','contract_from_date'];
    protected $fillable = [ "property_id", "role", "name", "housing_type_id", "tenant_name", "contract_number", "phone",
                            "whatsapp", "contract_from_date", "contract_to_date", "duration_contract", "rent","message",
                            "electricity_bill", "water_bill", "payment_system", "number_messages", "archive"];

    public function getElectricityBillAttribute($value)
    {
        return asset('/storage/images/bills/'.$value);
    }

    public function getWaterBillAttribute($value)
    {
        return asset('/storage/images/bills/'.$value);
    }

    /**  public function RealProperties . */
    public function realProperties()
    {
        return $this->hasMany(realProperties::class,'property_id');
    }
    
    /**  public function housingType . */
    public function housingType()
    {
        return $this->belongsTo(HousingType::class,'housing_type_id');
    }
}
