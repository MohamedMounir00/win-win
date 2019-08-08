<?php

namespace App\Http\Controllers\Api;

use App\Helper\Helper;
use App\Http\Resources\Api\ProfileCollection;
use App\State;
use App\City;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
       // Senior mediators
    public  function mediators()
    {
        $users=  User::where('verification',1)->whereHas('realtor', function ($q) {})->take(8)->get();

        return  ProfileCollection::collection($users);
    }
      ///get any settings by value
    public  function get_any_settings(Request $request)
    {

       $val= Helper::get_setting($request->value_name)->value;

        return response()->json(['data'=>$val]);
    }



    public function save_state(Request $request)
    {
     $name=[
    'ar'=>$request->name_ar,
    'en'=>$request->name_en
    ];
        $c= State::create(['name' => serialize($name),'city_id'=>$request->city_id]);
     return 'done';
    }
    
       public function save_city(Request $request)
    {
        $name=[
            'ar'=>$request->name_ar,
            'en'=>$request->name_en
        ];
        $c= City::create(['name' => serialize($name)]);
        return 'done';
    }
}
