<?php

namespace App\Http\Controllers\Frontend;

use App\City;
use App\Helper\Helper;
use App\Http\Resources\Api\CityCollection;
use App\Http\Resources\Api\StatusCollection;
use App\Http\Resources\Frontend\StataCollection;
use App\Mail\activeMail;
use App\State;
use App\Unit;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Alert;

class UserController extends Controller
{
    //


    public function __construct()
    {

        $this->middleware('active')->except('upload_image_profile');



    }

    public function seciend_step_view()
    {
        return view('frontend.main.complete_information');
    }

    public function seciend_step(Request $request)
    {

        $request->validate([
            //   'decs'=>'required',

            //'bio'=>'required',

          //  'phone' => 'min:11',

          ///  'address'=>'required',

        ]);

        if (Auth::check()){
            if(auth()->user()->register=='second_step')
                return redirect('/');

            $user= User::findOrFail(auth()->user()->id);

            $user->update([
                'phone'=>$request->phone,
                'register'=>'second_step',
            ]);
            $user->realtor->update([
                'bio'=>$request->bio,
                'phone1'=>$request->phone1,
                'phone2'=>$request->phone2,
                'phone3'=>$request->phone3,
                'address'=>$request->address,
            ]);
            Helper::mail($user->email,new activeMail());
            Alert::success(trans('frontend.success_and_addunit'))->persistent(trans('frontend.close'));

            return  redirect()->route('get_profile_view',$user->id);


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
        $state= State::where('city_id',$id)->orderBy('ordering','asc')->get();
        return StataCollection::collection($state);
    }

    public  function  upload_image_profile(Request $request)
    {
        $lang = $request->lang;

        $id = auth()->user()->id;
        $user = User::findOrFail($id);
        $user->image = Helper::UpdateImage($request, 'uploads/avatars/', 'image', $user->image);
        $user->save();
        $url= url($user->image);
        return (new StatusCollection(true, trans('api.update_done', [], $lang),$url))->response()
            ->setStatusCode(201);
    }
}
