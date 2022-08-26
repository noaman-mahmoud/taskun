<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Feature extends Model
{
    use UploadTrait , HasTranslations;

    protected $table    = "features";
    protected $fillable = ["type_id","feature","image"];

    public $translatable = ['feature'];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getImageAttribute($value)
    {
        return asset('/storage/images/features/'.$value);
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    /**  public function type . */
    public function type()
    {
        return $this->belongsTo(InputType::class,'type_id');
    }
    

}
