<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['name_en','name_ar','country_id'];
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function cities(){
        return $this->hasMany(City::class);
    }
    public function getCountryNameAttribute(){
        return $this->country ? $this->country->name : '';
    }
    public function getNameAttribute(){
        switch(config('app.locale')){
            case 'ar' : {return $this->name_ar;}break;
            case 'en' : {return $this->name_en;}break;
        }
    }
    public function getDeletedSinceAttribute(){
        return $this->deleted_at->diffForHumans() ?? '';
    }
}
