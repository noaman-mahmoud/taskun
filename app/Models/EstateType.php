<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class EstateType extends Model
{
    use UploadTrait , HasTranslations;

    protected $guarded = [];

    public $translatable = ['name'];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getImageAttribute($value)
    {
        return asset('/storage/images/estatetypes/'.$value);
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

}
