<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Frontend\StorgeCollection;
use App\Rating;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UnitCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $lang=$request->lang;
        $rating= Rating::where('realtor_id',$this->user_id)->where('type','admin')->get();
        $rating_admins=floatval($rating->avg('rating_stars'));
        $rating2= Rating::where('realtor_id',$this->user_id)->where('type','user')->get();
        $rating_users=floatval($rating2->avg('rating_stars'));

        if ($this->finishing=='without')
            $finishing=trans('backend.without');
        elseif ($this->finishing=='yes')
            $finishing=trans('backend.yes');
        elseif ($this->finishing=='no')
            $finishing=trans('backend.no');
        else
            $finishing=null;
        if ($this->status=='without')
            $status=trans('backend.without');
        elseif ($this->status=='rent')
            $status=trans('frontend.Rent');
        elseif ($this->status=='sale')
            $status=trans('frontend.Buy');
        else
            $status= null;
        if ($this->payment_method=='without')
            $payment_method=trans('backend.without');
        elseif ($this->payment_method=='cash')
            $payment_method=trans('frontend.Cash');
        elseif ($this->payment_method=='installments')

            $payment_method=trans('frontend.Instalment');
        else
            $payment_method= null;
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'desc'=>$this->desc,
            'type'=>unserialize($this->unit_type->name)[$lang],
            'rooms'=>$this->rooms,
            'price'=>isset($this->price)?$this->price:null,
            'floor'=>$this->floor,
            'area'=>$this->area,
            'bathroom'=>$this->bathroom,
            'status'=>$status,
            'finishing'=>$finishing,
            'payment_method'=>$payment_method,
            'city'=>isset($this->city_id)?unserialize($this->city->name)[$lang]:null,
            'state'=>isset($this->state_id)?unserialize($this->state->name)[$lang]:null,
            'date'=> \Carbon\Carbon::parse($this->created_at)->diffForHumans(),
            'storge'=>StorgeCollection::collection($this->storge),
            'activation'=>$this->activation_user,
            'lang'=>$lang,
            /////// realtor data
            'user_id'=>$this->user_id,
            'username'=>$this->realtor->name,
            'userimage'=> ($this->realtor->image!='') ? url($this->realtor->image) : '',
            'phone'=>$this->realtor->phone,
            'rating_users'=>$rating_users,
            'rating_admins'=>$rating_admins
        ];
    }
}
