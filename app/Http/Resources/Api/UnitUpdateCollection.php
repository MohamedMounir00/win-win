<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UnitUpdateCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    private $type,$city,$unit;
    public function __construct($type,$city,$unit)
    {
        $this->type = $type;
        $this->city = $city;
        $this->unit = $unit;
    }
    public function toArray($request)
    {
       return [
            'type'=>TypeCollection::collection($this->type),
            'city'=>CityCollection::collection($this->city),
            'unit'=>new UnitCollection($this->unit)
        ];
    }
}
