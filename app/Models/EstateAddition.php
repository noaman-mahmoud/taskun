<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class EstateAddition extends Model
{
    protected $table    = "estate_additions";
    protected $fillable = ['estate_id','addition_id'];

    /**  public function estate . */
    public function estate()
    {
        return $this->belongsTo(Estate::class , 'estate_id');
    }

    /**  public function addition . */
    public function addition()
    {
        return $this->belongsTo(Addition::class , 'addition_id');
    }

    /**  public function addition . */
    public function additions()
    {
        return $this->hasMany(Addition::class);
    }

}
