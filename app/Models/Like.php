<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table    = 'likes';
    protected $fillable = ["users","estate_id","count"];
    protected $casts    = ['users' => 'array'];

    /**  public function estate . */
    public function estate()
    {
        return $this->belongsTo(Estate::class,'estate_id');
    }

}
