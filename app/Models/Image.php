<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use UploadTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['image'];
    
    public function getImageAttribute($value)
    {
        return asset('/storage/images/images/'.$value);
    }

    public function setImageAttribute($value)
    {
        if ($value != null)
        {
            $this->attributes['image'] = $this->uploadAllTyps($value, 'images');
        }
    }

}
