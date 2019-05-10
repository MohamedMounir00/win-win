<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable ,SoftDeletes,HasApiTokens;
    use HasRoles;


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
        return $this->hasOne(Admin::class ,'user_id')->withTrashed();
    }
    public function realtor()
    {
        return $this->hasOne(Realtor::class ,'user_id')->withTrashed();
    }

    public function  city()
    {
        return $this->belongsTo(City::class,'city_id')->withTrashed();
    }
    public function  state()
    {
        return $this->belongsTo(State::class,'state_id')->withTrashed();
    }
}
