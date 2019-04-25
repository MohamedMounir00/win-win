<?php

namespace App\Http\Resources\Frontend;

use Illuminate\Http\Resources\Json\JsonResource;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
        $lang = LaravelLocalization::getCurrentLocale();
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
            'username'=>$this->realtor->name,
            'userimage'=>isset($this->realtor->image)?url($this->realtor->image):'',
            'phone'=>$this->realtor->phone,
            'type'=>unserialize($this->unit_type->name)[$lang],
            'rooms'=>$this->rooms,
            'price'=>isset($this->price)?($lang=='ar')?$this->price.'جنيه  ':$this->price.' L.E ':null,
            'floor'=>$this->floor,
            'area'=>$this->area,
            'bathroom'=>$this->bathroom,
            'status'=>$status,
            'finishing'=>$finishing,
            'payment_method'=>$payment_method,
            'city'=>isset($this->city_id)?unserialize($this->city->name)[$lang]:null,
            'state'=>isset($this->state_id)?unserialize($this->state->name)[$lang]:null,
            'date'=> date('Y-m-d' , strtotime($this->created_at)),
            'string_prics'=>($lang=='ar')?'السعر':'price',
            'url'=>route('details',$this->id),
            'storge'=>StorgeCollection::collection($this->storge),
            'activation'=>$this->activation_user,

        ];
    }
}
