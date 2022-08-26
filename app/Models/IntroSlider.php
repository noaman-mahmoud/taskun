<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class IntroSlider extends Model
{
    use UploadTrait ;
    use HasTranslations; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['image','title','description'];

    public $translatable = ['title' , 'description'];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getImageAttribute($value)
    {
        return asset('/storage/images/intro_sliders/'.$value);
    }

    public function setImageAttribute($value)
    {
        if ($value != null)
        {
            $this->attributes['image'] = $this->uploadAllTyps($value, 'intro_sliders' , 300 , null);
        }
    }
}
