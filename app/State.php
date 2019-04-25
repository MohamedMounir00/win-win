<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //
    protected $fillable=['name','city_id'];

    public function  city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

}
