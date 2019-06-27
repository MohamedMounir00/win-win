<?php

namespace App\Http\Resources\Frontend;

use App\Image;
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
    { $image = Image::find($this->image_id);
        $lang = isset($request->lang)?$request->lang:'ar';
        \Carbon\Carbon::setLocale($lang);

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
            'user_url' => route('get_profile_view',$this->user_id),
            'username'=>$this->realtor->name,
            'userimage'=> ($this->realtor->image!='') ? url($this->realtor->image) : 'https://www.mycustomer.com/sites/all/modules/custom/sm_pp_user_profile/img/default-user.png',
            'phone'=>$this->realtor->phone,
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
            'string_prics'=>($lang=='ar')?'السعر':'price',
            'url'=>route('details',$this->id),
            'storge'=>StorgeCollection::collection($this->storge),
            'activation'=>$this->activation_user,
            'lang'=>$lang,
                'route_update'=>route('edit-unit-page',$this->id),
             'default_image'=>url($image->url),
        ];
    }
}
