<?php

namespace App\Models;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Yajra\DataTables\Html\Options\HasFeatures;
use Illuminate\Support\Str;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use UploadTrait;
    use HasFeatures;

    protected $guarded = [];
    protected $hidden  = ['password', 'remember_token'];

    public function getAvatarAttribute($value)
    {
        return asset('/storage/images/users/'.$value);
    }

    public function getQrAttribute($value)
    {
        return asset('/storage/images/qr_codes/'.$value);
    }

    public function setAvatarAttribute($value)
    {

        if ($value != null)
        {
            $this->attributes['avatar'] = $this->uploadAllTyps($value, 'users' , 100 , 100);
        }
    }

    public function setPasswordAttribute($value)
    {
        if ($value != null)
        {
            $this->attributes['password'] = bcrypt($value);
        }
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function devices(){
        return $this->hasMany(UserToken::class);
    }

    public function scopeWithDevices($builder)
    {
        $builder
            ->join('user_tokens', 'users.id', '=', 'user_tokens.user_id')
            ->select('users.id as user_id', 'user_tokens.device_id', 'user_tokens.device_type');
    }

    public function replays()
    {
        return $this->morphMany(ComplaintReplay::class, 'replayer');
    }

    public function estates(){

        return $this->hasMany(Estate::class,'user_id')->where('publish',1);
    }

    public function city(){

        return $this->belongsTo(City::class,'city_id');
    }

}
