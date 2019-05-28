<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    public function reviews(){
        return $this->hasOne(Review::class);
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
