<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Branch extends Model
{
    use SoftDeletes;
    protected $fillable = ['name_en','name_ar','slug_en','slug_ar','provider_id','is_main'];
    public function setNameEnAttribute($value){
        $this->attributes['name_en'] = $value;
        $this->attributes['slug_en'] = Str::slug($value);
    }
    public function setNameArAttribute($value){
        $this->attributes['name_ar'] = $value;
        $this->attributes['slug_ar'] = preg_replace('/\s+/', '-', $value);
    }
    public function getNameAttribute(){
        return config('app.locale') =='en' ? $this->name_en : $this->name_ar ;
    }
    public function image()
    {
        return $this->morphOne(Media::class, 'mediable');
    }
    public function getImagePathAttribute(){
        return $this->image->path ?? 'logo.png';
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
    public function services(){
        return $this->hasMany(Service::class);
    }
    public function calendar(){
        return $this->hasOne(Calendar::class);
    }
    public function provider(){
        return $this->belongsTo(Provider::class);
    }
    public function exceptionWorkingDays(){
        return $this->hasMany(WorkExceptionDate::class);
    }
}
