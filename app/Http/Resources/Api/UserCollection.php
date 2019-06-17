<?php

namespace App\Http\Resources\Api;

use App\Rating;
use App\Unit;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $lang = isset($request->lang) ? $request->lang : 'ar';

        // count my rating for this user
        $ratingcount = Rating::where('realtor_id', $this->id)->where('user_id', auth()->user()->id)->where('type', 'user')->count();
        //my rating for this user
        $ratingme = Rating::where('realtor_id', $this->id)->where('user_id', auth()->user()->id)->where('type', 'user')->first();
        //rating admin
        $rating = Rating::where('realtor_id', $this->id)->where('type', 'admin')->get();
        $rating_time = floatval($rating->avg('rating_stars'));
        //rating  users
        $rating2 = Rating::where('realtor_id', $this->id)->where('type', 'user')->get();
        $rating_time_user = floatval($rating2->avg('rating_stars'));
        //get 3 rating
        $rating_3 = Rating::where('realtor_id', $this->id)->where('type', 'user')->take(3)->get();
        // Units available
        $count_active_unit = Unit::where('user_id', $this->id)->where('activation_admin', 'active')->where('activation_user', 'active')->count();
        //Units Not available
        $count_not_active_unit = Unit::where('user_id', $this->id)->where('activation_admin', 'not_active')->count();
        return [

            'user_id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'verification' => $this->verification,
            'register' => $this->register,
            'image' => ($this->image != '') ? url($this->image) : '',
            'city' => unserialize($this->city->name)[$lang],
            'state' => unserialize($this->state->name)[$lang],
            'bio' => $this->realtor->bio,
            'phone' => $this->phone,
            'phone1' => isset($this->realtor->phone1) ? $this->realtor->phone1 : '',
            'phone2' => isset($this->realtor->phone2) ? $this->realtor->phone2 : '',
            'phone3' => isset($this->realtor->phone3) ? $this->realtor->phone3 : '',
            'address' => $this->realtor->address,
            'company_name' => $this->realtor->company_name,
            'rating_admin' => $rating_time,
            'rating__user' => $rating_time_user,
            'rating_my_count' => $ratingcount,
            'ratingme' => $ratingme,
            'rating_3' => $rating_3,
            'count_units_available' => $count_active_unit,
            'count_units_not_available' => $count_not_active_unit,

        ];
    }
}
