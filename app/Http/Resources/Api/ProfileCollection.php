<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProfileCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $lang = isset($request->lang)?$request->lang:'ar';

        return [
            'user_id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'verification'=>$this->verification,
            'register'=>$this->register,
            'image'=>($this->image!='')?url($this->image):'',
            'city'=>unserialize($this->city->name)[$lang],
            'state'=>unserialize($this->state->name)[$lang],
            'bio'=>$this->realtor->bio,
            'phone'=>$this->phone,
            'phone1'=>isset($this->realtor->phone1)?$this->realtor->phone1:'',
            'phone2'=>isset($this->realtor->phone2)?$this->realtor->phone2:'',
            'phone3'=>isset($this->realtor->phone3)?$this->realtor->phone3:'',
            'address'=>$this->realtor->address,
            'company_name'=>$this->realtor->company_name,

        ];
    }
}
