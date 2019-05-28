<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Illuminate\Support\Facades\App;

class Country extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['name_en','name_ar'];
    public function states(){
        return $this->hasMany(State::class);
    }
    public function getDeletedSinceAttribute(){
        return $this->deleted_at->diffForHumans() ?? '';
    }
    public function getNameAttribute(){
        switch(config('app.locale')){
            case 'ar' : {return $this->name_ar;}break;
            case 'en' : {return $this->name_en;}break;
        }
    }
}
