<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
    protected $fillable = ['addressable_type','addressable_id','city_id','type','detailed_address','radius'];
    public function points(){
        return $this->hasMany(addressPoint::class);
    }
    public function point(){
        return $this->hasOne(addressPoint::class);
    }
}
