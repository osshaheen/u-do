<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Place extends Model
{
    use SoftDeletes;
    protected $fillable = ['name_en','bio_en','name_ar','bio_ar','service_type_id','slug_en','slug_ar'];

    public function setNameEnAttribute($value)
    {
        $this->attributes['name_en'] = $value;
        $this->attributes['slug_en'] = Str::slug($value);
    }
    public function setNameArAttribute($value)
    {
        $this->attributes['name_ar'] = $value;
        $this->attributes['slug_ar'] = preg_replace('/\s+/', '-', $value);
    }
    public function getBioAttribute(){
        switch(config('app.locale')){
            case 'ar' : {return $this->bio_ar;}break;
            case 'en' : {return $this->bio_en;}break;
        }
    }
    public function getNameAttribute(){
        switch(config('app.locale')){
            case 'ar' : {return $this->name_ar;}break;
            case 'en' : {return $this->name_en;}break;
        }
    }
    public function service_type(){
        return $this->belongsTo(ServiceType::class);
    }
    public function getServiceTypeNameAttribute(){
        return $this->service_type->name ?? '';
    }
    public function getDeletedSinceAttribute(){
        return $this->deleted_at->diffForHumans() ?? '';
    }
    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
    public function branches()
    {
        return $this->hasMany(PlaceBranch::class);
    }
}
