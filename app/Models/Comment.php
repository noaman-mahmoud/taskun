<?php

namespace App\Models;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table   = "comments";
    protected $guarded = [];

    /**  public function user . */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
