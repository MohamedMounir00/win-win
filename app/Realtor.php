<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Realtor extends Model
{
    //
    use SoftDeletes;
    protected $fillable=['company_name','bio','phone1','phone2','phone3','address','user_id'];
}
