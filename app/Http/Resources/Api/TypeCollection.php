<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TypeCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $lang = isset($request->lang)?$request->lang:'ar';
        return [
            'id' => $this->id,
            'type' => unserialize($this->name)[$lang],
        ];
    }
}