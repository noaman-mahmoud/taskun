<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class IntroHowWork extends Model
{
    use UploadTrait ;
    use HasTranslations; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','image'];
    
    public $translatable = ['title'];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getImageAttribute($value)
    {
        return asset('/storage/images/how_works/'.$value);
    }

    public function setImageAttribute($value)
    {
        if ($value != null)
        {
            $this->attributes['image'] = $this->uploadAllTyps($value, 'how_works' ,300 , null);
        }
    }
}
