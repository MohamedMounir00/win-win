<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question_rel extends Model
{
    //
    public function name()
    {
        return $this->hasMany(Question::class,'q_id');
    }
}
