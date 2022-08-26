<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $table    = "complaints";
    protected $fillable = ['title','phone','email','complaint','user_id'];

    /**
     * Get the user that owns the Complaint
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get all of the replays for the Complaint
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replays()
    {
        return $this->hasMany(ComplaintReplay::class, 'complaint_id', 'id');
    }
}
