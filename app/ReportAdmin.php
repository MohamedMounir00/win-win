<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportAdmin extends Model
{
    protected  $fillable=['user_id','title','report','realtor_id'];


    public function realtor()
    {
        return $this->belongsTo(User::class ,'user_id')->withTrashed();
    }
}