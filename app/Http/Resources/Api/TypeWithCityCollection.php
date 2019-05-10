<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TypeWithCityCollection extends Resource
{
   private $city,$type;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public  function __construct($city,$type)
    {
       $this->city=$city;
      $this->type=$type;
    }

    public function toArray($request)
    {
        return [
            'city'=>CityCollection::collection($this->city),
            'type'=>TypeCollection::collection($this->type)
        ];
    }
}
