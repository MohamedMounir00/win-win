<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','city_id','state_id','phone','image','verification','register'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function admins()
    {
        return $this->hasOne(Admin::class ,'user_id');
    }
    public function realtor()
    {
        return $this->hasOne(Realtor::class ,'user_id');
    }

    public function  city()
    {
        return $this->belongsTo(City::class,'city_id');
    }
    public function  state()
    {
        return $this->belongsTo(State::class,'state_id');
    }
}
