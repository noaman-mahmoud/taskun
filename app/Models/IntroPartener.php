<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;

class IntroPartener extends Model
{
    use UploadTrait ;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['image'];

    public function getImageAttribute($value)
    {
        return asset('/storage/images/parteners/'.$value);
    }

    public function setImageAttribute($value)
    {
        if ($value != null)
        {
            $this->attributes['image'] = $this->uploadAllTyps($value, 'parteners' ,300 , null);
        }
    }
}
