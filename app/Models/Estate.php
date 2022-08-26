<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;


class Estate extends Model
{
    use UploadTrait;
    protected $table     = "estates";
    protected $fillable  = [ "user_id", "city_id", "user_type", "type", "address", "lat", "lng", "category_id",
                             "title", "estate_category_id", "sale_type", "entrustment", "price", "neighborhood",
                             "planned", "description", "whatsapp", "username", "user_whatsapp", "user_phone", "publish",
                             "views", "archive"];

    public function getImageAttribute($value)
    {
        return asset('/storage/images/estate_images/'.$value);
    }

    /**  public function relation rates . */
    public function rates()
    {
        return $this->hasMany(Comment::class);
    }

    /**  public function relation likes . */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**  public function relation provider . */
    public function provider()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    /**  public function relation city . */
    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    /**  public function relation category . */
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    /**  public function  relation estateCategory . */
    public function estateCategory()
    {
        return $this->belongsTo(EstateCategory::class,'estate_category_id');
    }

    /**  public function estate Image . */
    public function estateImage()
    {
        return $this->hasOne(EstateImage::class,'estate_id');
    }

}
