<?php

namespace App\Models;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;

class EstateImage extends Model
{
    use UploadTrait;

    protected $fillable = ["estate_id","image"];
    protected $table    = "estate_images";

    public function getImageAttribute($value)
    {
        return asset('/storage/images/estate_images/'.$value);
    }

    /**  public function rates . */
    public function rates()
    {
        return $this->hasMany(Comment::class);
    }

    /**  public function user . */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
