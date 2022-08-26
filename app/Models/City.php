<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasTranslations;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable  = ['name','country_id','lat','lng'];

    public $translatable = ['name'];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Get the country that owns the City
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
