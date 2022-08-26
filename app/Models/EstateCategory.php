<?php

namespace App\Models;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class EstateCategory extends Model
{
    use UploadTrait , HasTranslations;

    protected $table    = "estate_categories";
    protected $fillable = ["name"];

    public $translatable = ['name'];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public function getImageAttribute($value)
    {
        return asset('/storage/images/estate-categories/'.$value);
    }


}
