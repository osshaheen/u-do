<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;
    protected $fillable = ['name_en','name_ar','state_id'];
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function getStateNameAttribute(){
        return $this->state ? $this->state->name : '';
    }
    public function getCountryNameAttribute(){
        return $this->state ? ($this->state->country ? $this->state->country->name : '') : '';
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
