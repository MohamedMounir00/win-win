<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type_estate extends Model
{
    //
    use SoftDeletes;

    protected $fillable=['name'];

    public function questions()
    {
        return $this->belongsToMany(Question::class,'question_rels','type_id','q_id');
    }


}
