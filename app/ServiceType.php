<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceType extends Model
{
    use SoftDeletes;
    protected $fillable = ['name_en','description_en','name_ar','description_ar','price','point_type_id'];
    public function providers(){
        return $this->hasMany(Provider::class);
    }
    public function point_type(){
        return $this->belongsTo(PointType::class);
    }
    public function getPointTypeNameAttribute(){
        return $this->point_type->name ?? '';
    }
    public function tags(){
        return $this->belongsToMany(Tag::class,'service_type_tags')->withPivot('id','deleted_at');
    }
    public function places(){
        return $this->hasMany(Place::class);
    }
    public function getDeletedSinceAttribute(){
        return $this->deleted_at->diffForHumans() ?? '';
    }
    public function categories(){
        return $this->hasMany(Category::class);
    }
    public function getNameAttribute(){
        return config('app.locale') == 'en' ? $this->name_en : $this->name_ar ;
    }
    public function getDescriptionAttribute(){
        return config('app.locale') == 'en' ? $this->description_en : $this->description_ar ;
    }
}
