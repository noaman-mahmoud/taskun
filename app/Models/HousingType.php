<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HousingType extends Model
{
    use UploadTrait , HasTranslations;

    protected $table    = "housing_types";
    protected $fillable = ["name","estate_type_id"];

    public $translatable = ['name'];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public function getImageAttribute($value)
    {
        return asset('/storage/images/housingtypes/'.$value);
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    /**  public function estateType . */
    public function estateType()
    {
       return $this->belongsTo(EstateType::class,'estate_type_id');
    }

    
}
