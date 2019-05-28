<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = ['service_type_id','root_id','parent_id','level','priority','is_leaf','name_en','slug_en','description_en','name_ar','slug_ar','description_ar'];
    public function service_type(){
        return $this->belongsTo(ServiceType::class);
    }
    public function parent(){
        return $this->belongsTo(Category::class,'parent_id','id');
    }
    public function setNameEnAttribute($value){
        $this->attributes['name_en'] = $value;
        $this->attributes['slug_en'] = Str::slug($value);
    }
    public function setNameArAttribute($value){
        $this->attributes['name_ar'] = $value;
        $this->attributes['slug_ar'] = preg_replace('/\s+/', '-', $value);
    }
    public function setDescriptionArAttribute($value){
        $this->attributes['description_ar'] = $value;
    }
    public function setDescriptionEnAttribute($value){
        $this->attributes['description_en'] = $value;
    }
    public function setParentIdAttribute($value){
        if($value) {
            $this->attributes['parent_id'] = $value;
        }else{
            $this->attributes['parent_id'] = 0;
        }
    }
    public function setRootIdAttribute($value){
        if($value) {
            $this->attributes['root_id'] = $value;
        }else{
            $this->attributes['root_id'] = 0;
        }
    }
    public function getNameAttribute(){
        switch(config('app.locale')){
            case 'ar' : {return $this->name_ar;}break;
            case 'en' : {return $this->name_en;}break;
        }
    }
    public function getDescriptionAttribute(){
        switch(config('app.locale')){
            case 'ar' : {return $this->name_ar;}break;
            case 'en' : {return $this->name_en;}break;
        }
    }
    public function categories(){
        return $this->hasMany(Category::class,'parent_id','id');
    }
    public function sons(){
        return $this->hasMany(Category::class,'root_id','id');
    }
    public function image()
    {
        return $this->morphOne(Media::class, 'mediable');
    }
    public function getImagePathAttribute(){
        return $this->image->path ?? 'logo.png';
    }
    public function getDeletedSinceAttribute(){
        return $this->deleted_at->diffForHumans() ?? '';
    }
}
