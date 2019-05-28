<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    protected $fillable = ['name_en','name_ar'];
    use SoftDeletes;
    public function service_types(){
        return $this->belongsToMany(ServiceType::class,'service_type_tags');
    }
    public function getDeletedSinceAttribute(){
        return $this->deleted_at->diffForHumans() ?? '';
    }
    public function services(){
        return $this->belongsToMany(Service::class,'service_tags')->withPivot('id','service_id','tag_id');
    }
    public function getNameAttribute(){
        return config('app.locale') == 'en' ? $this->name_en : $this->name_ar ;
    }
}
