<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class UnitDate extends Model
{
    protected $table   = "unit_dates";
    protected $casts   = ['date'];
    protected $guarded = [];

    /**  public function units . */
    public function units()
    {
        return $this->hasMany(HousingUnit::class,'unit_id');
    }

    /**  public function unit . */
    public function unit()
    {
        return $this->belongsTo(HousingUnit::class,'unit_id');
    }
}
