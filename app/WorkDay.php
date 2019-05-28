<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkDay extends Model
{
    use SoftDeletes;
    protected $fillable = ['calendar_id','week_day_id','max_number','from','to'];
    public function calendar(){
        return $this->belongsTo(Calendar::class);
    }
}
