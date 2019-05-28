<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rank extends Model
{
    use SoftDeletes;
    protected $fillable = ['title_en','title_ar'];
    public function providers(){
        return $this->hasMany(Provider::class);
    }
    public function getDeletedSinceAttribute(){
        return $this->deleted_at->diffForHumans() ?? '';
    }
    public function getTitleAttribute(){
        return config('app.locale') == 'en' ? $this->title_en : $this->title_ar ;
    }
}
