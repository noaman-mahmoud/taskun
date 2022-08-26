<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class IntroFqsCategory extends Model
{
    use HasTranslations; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = ['title'];
    
    public $translatable = ['title'];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Get all of the questions for the IntroFqsCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(IntroFqs::class, 'intro_fqs_category_id', 'id');
    }
}
