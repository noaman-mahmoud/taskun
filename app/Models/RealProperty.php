<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RealProperty extends Model
{
    protected $fillable  = ["user_id","name","estate_type_id","housing_type_id",
                            "address","lat","lng","number_roles","image"];

    protected $table     = "real_properties";

    /**  public function estateType . */
    public function estateType()
    {
       return $this->belongsTo(EstateType::class,'estate_type_id');
    }

    /**  public function housingType . */
    public function housingType()
    {
       return $this->belongsTo(HousingType::class,'housing_type_id');
    }

    /**  public function units . */
    public function units()
    {
        return $this->hasMany(HousingUnit::class,'property_id');
    }

}
