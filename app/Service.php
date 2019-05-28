<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    protected $fillable = ['branch_id','category_id','name_ar','description_ar','name_en','description_en','expired_at'];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function getDeletedSinceAttribute(){
        return $this->deleted_at->diffForHumans();
    }
    public function tags(){
        return $this->belongsToMany(Tag::class,'service_tags')->withPivot('id','service_id','tag_id');
    }
    public function getNameAttribute(){
        return config('app.locale') == 'en' ? $this->name_en : $this->name_ar ;
    }
    public function getDescriptionAttribute(){
        return config('app.locale') == 'en' ? $this->description_en : $this->description_ar ;
    }
}
