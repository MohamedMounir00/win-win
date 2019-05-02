<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    protected $fillable=['title',
        'desc',
        'type_id',
        'rooms',
        'price',
        'floor',
        'area',
        'bathroom',
        'status',
        'finishing',
        'payment_method',
        'city_id',
        'state_id',
        'user_id',];


    public function storge()
    {
        return $this->belongsToMany(Image::class,'image_rels','uint_id')->withTimestamps();
    }

    public function  city()
    {
        return $this->belongsTo(City::class,'city_id')->withTrashed();
    }
    public function  state()
    {
        return $this->belongsTo(State::class,'state_id')->withTrashed();
    }

    public function  unit_type()
    {
        return $this->belongsTo(Type_estate::class,'type_id')->withTrashed();
    }
    public function realtor()
    {
        return $this->belongsTo(User::class ,'user_id')->withTrashed();
    }
}
