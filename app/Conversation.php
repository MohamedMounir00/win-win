<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    //
    protected $fillable=['sender_id','receiver_id','updated_at'];

    public function messages()
    {
        return $this->hasMany(Chat::class );
    }
    public function sender()
    {
        return $this->belongsTo(User::class ,'sender_id');
    }
    public function receiver()
    {
        return $this->belongsTo(User::class ,'receiver_id');
    }
}
