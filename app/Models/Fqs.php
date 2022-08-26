<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fqs extends Model
{
    use HasTranslations; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['question','answer'];
    
    public $translatable = ['question','answer'];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
