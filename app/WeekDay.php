<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeekDay extends Model
{
    protected $fillable = ['day_en','day_ar'];
    use SoftDeletes;
    public function getDeletedSinceAttribute(){
        return $this->deleted_at->diffForHumans();
    }
    public function calendar(){
        return $this->belongsToMany(Calendar::class,'work_days')->withPivot('id','calendar_id','week_day_id','max_number','from','to');
    }
    public function getDayAttribute(){
        return config('app.locale') == 'en' ? $this->day_en : $this->day_ar ;
    }
    public function getCalenderPivotObjectAttribute(){
        return $this->calendar()->count() ? $this->calendar[0]->pivot : '';
    }
}
