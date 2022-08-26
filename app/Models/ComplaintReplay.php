<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintReplay extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['replay','replayer_id','replayer_type' , 'complaint_id'];

    public function replayer()
    {
        return $this->morphTo();
    }


    /**
     * Get the complaint that owns the ComplaintReplay
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function complaint()
    {
        return $this->belongsTo(Complaint::class, 'complaint_id', 'id');
    }
}
