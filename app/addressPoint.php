<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class addressPoint extends Model
{
//    use SoftDeletes;
    protected $fillable = ['lat','lng','address_id'];
}
