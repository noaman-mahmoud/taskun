<?php

namespace App\Models;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;

class InputType extends Model
{
    protected $fillable = ["type","name"];
    protected $table    = "inputs_types";
}
