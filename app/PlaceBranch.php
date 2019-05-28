<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class PlaceBranch extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['place_id','name_en','slug_en','name_ar','slug_ar','is_main'];
    public function getIsMainTagAttribute(){
        switch($this->is_main){
            case 0:{
                return '<a href="'.route('setPlaceBranchMain',$this->id).'">'.trans("Places\branches\branches.main").'</a>';
            }break;
            case 1:{
                return '';
            }break;
        }
    }
    public function setNameEnAttribute($value){
        $this->attributes['name_en'] = $value;
        $this->attributes['slug_en'] = Str::slug($value);
    }
    public function setNameArAttribute($value){
        $this->attributes['name_ar'] = $value;
        $this->attributes['slug_ar'] = preg_replace('/\s+/', '-', $value);
    }
    public function getNameAttribute(){
        switch(config('app.locale')){
            case 'ar' : {return $this->name_ar;}break;
            case 'en' : {return $this->name_en;}break;
        }
    }
    public function getAddressLatAttribute(){
        return $this->address->point->lat ?? 0;
    }
    public function getAddressLngAttribute(){
        return $this->address->point->lng ?? 0;
    }
    public function getAddressIdAttribute(){
        return $this->address->id ?? 0;
    }
    public function getDeletedSinceAttribute(){
        return $this->deleted_at->diffForHumans();
    }
    public function address(){
        return $this->morphOne(Address::class, 'addressable');
    }
}
