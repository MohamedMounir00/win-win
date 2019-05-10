<?php

namespace App\Http\Controllers\Frontend;

use App\City;
use App\Http\Resources\Api\CityCollection;
use App\Http\Resources\Frontend\StataCollection;
use App\State;
use App\Unit;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //


    public function __construct()
    {

        $this->middleware('active');



    }

    public function seciend_step_view()
    {
        return view('frontend.main.complete_information');
    }

    public function seciend_step(Request $request)
    {

        $request->validate([
            //   'decs'=>'required',

            'bio'=>'required',

            'phone' => 'min:11',

            'address'=>'required',

        ]);

        if (Auth::check()){
            if(auth()->user()->register=='second_step')
                return redirect('/');

            $user= User::findOrFail(auth()->user()->id);

            $user->update([
                'phone'=>$request->phone,
                'register'=>'second_step'
            ]);
            $user->realtor->update([
                'bio'=>$request->bio,
                'phone1'=>$request->phone1,
                'phone2'=>$request->phone2,
                'phone3'=>$request->phone3,
                'address'=>$request->address,
            ]);
            return redirect()->route('add-unit-page');

        }else{
            return redirect()->route('login');
        }


    }
    public function thank_view()
    {
        $count = Unit::where('user_id', auth()->user()->id)->count();
        if ($count >= 10)
            return view('frontend.main.thank_you');
        else{
        return redirect()->route('add-unit-page');

          }
    }

    public function stateByid(Request $request)
    {
        $id=$request->city_id;
        $state= State::where('city_id',$id)->get();
        return StataCollection::collection($state);
    }
}
