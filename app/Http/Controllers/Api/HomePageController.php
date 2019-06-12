<?php

namespace App\Http\Controllers\Api;

use App\Helper\Helper;
use App\Http\Resources\Api\ProfileCollection;
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
}
