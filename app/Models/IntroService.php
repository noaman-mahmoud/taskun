<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class IntroService extends Model
{
    use HasTranslations; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title' , 'description'];
    
    public $translatable = ['title' , 'description'];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
