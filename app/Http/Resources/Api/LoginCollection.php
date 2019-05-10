<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LoginCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->realtor)
            $role='realtor';
        else
            $role='admin';

        return[

            'user_id'=>$this->id,
            'name'=>$this->name,
            'verification'=>$this->verification,
            'register'=>$this->register,
            'image'=>($this->image!='')?url($this->image):'',
            'role'=>$role,
            'token'=>$this->token
        ];
    }
}
