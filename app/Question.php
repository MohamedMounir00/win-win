<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $hidden =['id','key','created_at','updated_at','pivot'];


}
