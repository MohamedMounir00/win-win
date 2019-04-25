<?php

namespace App\Http\Resources\Frontend;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class StataCollection extends JsonResource
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

        return [
            'id'=>$this->id,
        'state'=>unserialize($this->name)[$lang],

        ];
    }
}
