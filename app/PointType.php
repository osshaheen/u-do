<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PointType extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['name_en','description_en','name_ar','description_ar','points'];
    public function service_types(){
        return $this->hasMany(ServiceType::class);
    }
    public function getDeletedSinceAttribute(){
        return $this->deleted_at->diffForHumans() ?? '';
    }
    public function getNameAttribute(){
        return config('app.locale') == 'en' ? $this->name_en : $this->name_ar ;
    }
    public function getDescriptionAttribute(){
        return config('app.locale') == 'en' ? $this->description_en : $this->description_ar ;
    }
}
