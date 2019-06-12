<?php

namespace App\Http\Resources\Api;

use App\Chat;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $count= Chat::where('conversation_id',$this->id)->where('receiver_id',auth()->user()->id)->where('seen',false)->count();
        $language = $request->lang;
        \Carbon\Carbon::setLocale($language);
        $user_id=auth()->user()->id;
        $user_data ='';
        if ($this->sender_id === $user_id)
            $user_data = $this->receiver;
        else
            $user_data = $this->sender;

        $last_message=Chat::where('conversation_id',$this->id)->latest()->first();
        return [
            'conversation_id'=>$this->id,
            'user_name'=>$user_data->name,
            'user_image'=>($user_data->image!='')?url($user_data->image):'',
            'last_message'=>$last_message->message,
            'date'=> \Carbon\Carbon::parse($this->updated_at)->diffForHumans(),
            'count'=>$count,
            'reciver_id'=>$user_data->id
        ];
    }
}
