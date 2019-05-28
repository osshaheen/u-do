<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlaceDetails extends Model
{
//    use SoftDeletes;
    protected $fillable = ['property_en','value_en','property_ar','value_ar','branch_id'];
}
