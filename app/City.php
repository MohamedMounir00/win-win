<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    //
    use SoftDeletes;

    protected $fillable=['name','ordering'];
public function scopeOrdered($query)
{
    return $this->orderBy('ordering', 'asc')->get();
}


}
