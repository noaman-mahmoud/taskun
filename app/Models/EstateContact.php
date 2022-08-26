<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class EstateContact extends Model
{
    protected $table    = "estate_contacts";
    protected $fillable = ["estate_id",'phone'];

    /**  public function estate . */
    public function estate()
    {
        return $this->belongsTo(Estate::class , 'estate_id');
    }
}
