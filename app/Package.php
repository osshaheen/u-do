<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;
    protected $fillable =['name_en','name_ar','points','description_en','description_ar'];
    public function getDeletedSinceAttribute(){
        return $this->deleted_at->diffForHumans();
    }

    public function getNameAttribute(){
        switch(config('app.locale')){
            case 'ar' : {return $this->name_ar;}break;
            case 'en' : {return $this->name_en;}break;
        }
    }
    public function getDescriptionAttribute(){
        switch(config('app.locale')){
            case 'ar' : {return $this->description_ar;}break;
            case 'en' : {return $this->description_en;}break;
        }
    }
}
