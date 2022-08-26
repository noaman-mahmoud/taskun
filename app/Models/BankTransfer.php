<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class BankTransfer extends Model
{
    use UploadTrait;
    use HasTranslations;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['user_id','name','account_owner','account_number','amount','image'];

    public $translatable = [];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public function getImageAttribute($value)
    {
        return asset('/storage/images/BankTransfers/'.$value);
    }


}
