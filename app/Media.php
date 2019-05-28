<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    //
    protected $fillable = ['mediable_type','mediable_id','type','path','is_main','original_name'];
    use SoftDeletes;
    public function getDeletedSinceAttribute(){
        return $this->deleted_at->diffForHumans() ?? '';
    }
    public function getMediaPathAttribute(){
        switch ($this->type) {
            case 'image/png' : {return '<a class="image-popup-vertical-fit" href="'.asset('storage/'.$this->path).'"><img src="'.asset('storage/'.$this->path).'" alt="place media" /></a>' ?? 'logo.png';}break;
            case 'image/jpeg' : {return '<a class="image-popup-vertical-fit" href="'.asset('storage/'.$this->path).'"><img src="'.asset('storage/'.$this->path).'" alt="place media" /></a>' ?? 'logo.png';}break;
            case 'image/jpg' : {return '<a class="image-popup-vertical-fit" href="'.asset('storage/'.$this->path).'"><img src="'.asset('storage/'.$this->path).'" alt="place media" /></a>' ?? 'logo.png';}break;
            case 'image/bmp' : {return '<a class="image-popup-vertical-fit" href="'.asset('storage/'.$this->path).'"><img src="'.asset('storage/'.$this->path).'" alt="place media" /></a>' ?? 'logo.png';}break;
            case 'video/avi' : {return '<video width="400" controls><source src="'.asset('storage/'.$this->path).'" type="'.$this->type.'"></video>' ?? '';}break;
            case 'video/mp4' : {return '<video width="400" controls><source src="'.asset('storage/'.$this->path).'" type="'.$this->type.'"></video>' ?? '';}break;
            case 'video/x-msvideo' : {return '<video width="400" controls><source src="'.asset('storage/'.$this->path).'" type="'.$this->type.'"></video>' ?? '';}break;
            case 'video/quicktime' : {return '<video width="400" controls><source src="'.asset('storage/'.$this->path).'" type="'.$this->type.'"></video>' ?? '';}break;
            case 'video/x-ms-wmv' : {return '<video width="400" controls><source src="'.asset('storage/'.$this->path).'" type="'.$this->type.'"></video>' ?? '';}break;
            case 'video/3gpp' : {return '<video width="400" controls><source src="'.asset('storage/'.$this->path).'" type="'.$this->type.'"></video>' ?? '';}break;
            case 'video/MP2T' : {return '<video width="400" controls><source src="'.asset('storage/'.$this->path).'" type="'.$this->type.'"></video>' ?? '';}break;
            case 'video/x-mpegURL' : {return '<video width="400" controls><source src="'.asset('storage/'.$this->path).'" type="'.$this->type.'"></video>' ?? '';}break;
        }
    }
}
