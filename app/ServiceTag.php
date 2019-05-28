<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceTag extends Model
{
    protected $fillable = ['service_id','tag_id'];
}
