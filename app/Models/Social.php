<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use UploadTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = ['link' , 'icon' , 'name'];

    public function getIconAttribute($value)
    {
        return asset('/storage/images/socials/'.$value);
    }

    public function setIconAttribute($value)
    {
        if ($value != null)
        {
            $this->attributes['icon'] = $this->uploadAllTyps($value, 'socials' , 300 , null);
        }
    }
}
