<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ChatCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {            $language = $request->lang;
                \Carbon\Carbon::setLocale($language);

        return [
            'sender_name'=>$this->sender->name,
            'sender_id'=>$this->sender_id,
            'sender_image'=>($this->sender->image!='')?url($this->sender->image):'',
            'receiver_name'=>$this->receiver->name,
            'receiver_id'=>$this->receiver_id,
            'receiver_image'=>($this->receiver->image!='')?url($this->receiver->image):'',
            'text'=>$this->message,
            'date'=> \Carbon\Carbon::parse($this->created_at)->diffForHumans()

        ];
    }
}
