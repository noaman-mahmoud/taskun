<?php

namespace App\Models;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Bank extends Model
{
    use UploadTrait;
    use HasTranslations;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable  = ['bank_name','account_name','account_number','iban_number','image'];

    public $translatable = [];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public function getImageAttribute($value)
    {
        return asset('/storage/images/banks/'.$value);
    }


}
