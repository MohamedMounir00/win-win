<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use SoftDeletes;

    protected $fillable=['name','city_id','ordering'];

    public function  city()
    {
        return $this->belongsTo(City::class,'city_id')->withTrashed();
    }

}
