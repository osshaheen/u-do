<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Provider extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['user_id','rank_id','service_type_id','name_en','slug_en','bio_en','name_ar','slug_ar','bio_ar'];

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
    public function views(){
        return $this->belongsToMany(User::class,'views')->withTimestamps();//->withPivot('id','created_at');
    }
    public function ranks(){
        return $this->belongsTo(Rank::class,'rank_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function ratings(){
        return $this->hasMany(Rating::class);
    }
    public function service_type(){
        return $this->belongsTo(ServiceType::class,'service_type_id','id');
    }
    public function branches(){
        return $this->hasMany(Branch::class);
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
    public function getNameAttribute(){
        return config('app.locale') == 'en' ? $this->name_en : $this->name_ar ;
    }
    public function getBioAttribute(){
        return config('app.locale') == 'en' ? $this->bio_en : $this->bio_ar ;
    }
    public function getUserNameAttribute(){
        return $this->user ? $this->user->username : '' ;
    }

}
