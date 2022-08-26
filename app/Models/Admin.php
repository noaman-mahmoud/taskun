<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable 
{
    use Notifiable;
    use UploadTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable     = ['name','phone','email','password','avatar','role_id','is_notify','block'];

    protected $guarded      = ['id'];

    protected $hidden       = [
        'password',
    ];

    public function getAvatarAttribute($value)
    {
        return asset('/storage/images/admins/'.$value);
    }

    public function setAvatarAttribute($value)
    {
        if ($value != null)
        {
            $this->attributes['avatar'] = $this->uploadAllTyps($value, 'admins' , 300 , null);
        }
    }

    public function role()
    {
        return $this->belongsTo(Role::class)->withTrashed();
    }
    public function setPasswordAttribute($value)
    {
        if ($value != null)
        {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function replays()
    {
        return $this->morphMany(ComplaintReplay::class, 'replayer');
    }

}
