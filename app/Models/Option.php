<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Option extends Model
{
    use HasTranslations;
    
    protected $fillable  = ["feature_id","name"];
    protected $table     = "options";
    public $translatable = ['name'];

}
