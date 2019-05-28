<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkExceptionDate extends Model
{
    protected $fillable = ['day','branch_id'];
    use SoftDeletes;
    public function getDeletedSinceAttribute(){
        return $this->deleted_at->diffforhumans();
    }
}
