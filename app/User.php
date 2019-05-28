<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable,SoftDeletes,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username_en','username_ar', 'phone', 'password','email','language','is_blocked','phone_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function provider(){
        return $this->hasOne(Provider::class);
    }
    public function getIsProviderAttribute(){
        switch ($this->provider_count){
            case 1:{
                return '<a href="/getProviderDetails/'.$this->provider->id. '">details</a>';
            }break;
            case 0:{
                return '<a href="/makeProvider/'.$this->id. '">make provider</a>';
            }break;
        }
    }
    public function getPhoneVerifiedAttribute(){
//        return $this->created_at->diffForHumans();
        if($this->phone_verified_at) {
            return Carbon::createFromTimeString($this->phone_verified_at)->diffForHumans();
        }else{
            return 'not verified yet';
        }
    }
    public function setPhoneVerifiedAtAttribute($value)
    {
        $this->attributes['phone_verified_at'] = Carbon::createFromFormat('Y-m-d H:i:s', $value);;
    }
    public function getViewCreatedAtAttribute()
    {
        if (is_null($this->pivot)) return null;

        return $this->pivot->created_at ? $this->pivot->created_at->diffForHumans() : '';
    }
    public function image()
    {
        return $this->morphOne(Media::class, 'mediable');
    }
    public function getImagePathAttribute(){
        return $this->image->path ?? 'logo.png';
    }
    public function getDeletedSinceAttribute(){
        return $this->deleted_at->diffForHumans() ?? '';
    }
    public function getProviderNameEnAttribute(){
        return $this->provider ? $this->provider->name_en : '' ;
    }
    public function getProviderNameArAttribute(){
        return $this->provider ? $this->provider->name_ar : '' ;
    }
    public function getUserNameAttribute(){
        return config('app.locale') == 'en' ? $this->username_en : $this->username_ar ;
    }

}
