<?php

namespace App\Models;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class EstateFeature extends Model
{
    protected $table    = "estate_features";
    protected $fillable = ["estate_id","feature_id","type","value","option_id"];

    /**  public function estate . */
    public function estate()
    {
        return $this->belongsTo(Estate::class , 'estate_id');
    }

    /**  public function feature . */
    public function feature()
    {
        return $this->belongsTo(Feature::class , 'feature_id');
    }

    /**  public function features . */
    public function features()
    {
        return $this->hasMany(Feature::class);
    }
    
    /**  public function option . */
    public function option()
    {
        return $this->belongsTo(Option::class,'option_id');
    }
}
