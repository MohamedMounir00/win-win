<?php

namespace App\Http\Controllers\Frontend;

use App\City;
use App\Helper\Helper;
use App\Http\Requests\Frontend\UpdateProfileRequest;
use App\Http\Resources\Api\StatusCollection;
use App\Rating;
use App\ReportAdmin;
use App\State;
use App\Unit;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;
use Illuminate\Support\Facades\Hash;

class MainProfileController extends Controller
{
    //
    public function __construct()
    {

        /// middleware for  active user
     //   $this->middleware('NotActive')->except('get_all_comment');
        $this->middleware('auth')->except('get_all_comment');

    }

    /// get view  profile
    public function profile($id)
    {
        $user = User::findOrFail($id);
       if ($user->realtor)
       {
           if (auth()->user()->id!=$id&&auth()->user()->verification==false)
               return  redirect()->route('get_profile_view',auth()->user()->id);

           // count my rating for this user

           $ratingcount = Rating::where('realtor_id', $id)->where('user_id', auth()->user()->id)->where('type', 'user')->count();
           //my rating for this user

           $ratingme = Rating::where('realtor_id', $id)->where('user_id', auth()->user()->id)->where('type', 'user')->first();
           ///rating admin

           $rating = Rating::where('realtor_id', $id)->where('type', 'admin')->get();
           $rating_time = floatval($rating->avg('rating_stars'));
           //rating  users

           $rating2 = Rating::where('realtor_id', $id)->where('type', 'user')->get();
           $rating_time_user = floatval($rating2->avg('rating_stars'));
           //get 3 rating
           $rating_10= Rating::where('realtor_id', $id)->orderByDesc('created_at')->take(3)->get();
           $count_active_unit= Unit::where('user_id',$id)->where('activation_admin', 'active')->where('activation_user', 'active')->count();
           $count_not_active_unit= Unit::where('user_id',$id)->where('activation_admin', 'not_active')->where('activation_user', 'not_active')->count();
           $count_active_unit_me= Unit::where('user_id',$id)->where('activation_user', 'active')->count();
           $count_not_active_unit_me= Unit::where('user_id',$id)->where('activation_user', 'not_active')->count();
           return view('frontend.pages.profile', compact('user', 'rating_time', 'rating_time_user', 'rating2', 'ratingcount',
               'ratingme','rating_10',
               'count_active_unit',
               'count_not_active_unit','count_active_unit_me','count_not_active_unit_me'));
       }
       else
           return redirect()->route('home');

    }
    /// addRating in page profile realtor
    public function addRating(Request $request)
    {

        if (auth()->user()->admins) {
            $rating = new Rating;
            $rating->user_id = auth()->user()->id;
            $rating->realtor_id = $request->realtor_id;
            $rating->rating_stars = $request->star;
            $rating->comment = $request->comment;
            $rating->type = 'admin';
            $rating->save();
            return $rating;
        } else {
            $ratingcount = Rating::where('realtor_id', $request->realtor_id)->where('user_id', auth()->user()->id)->where('type', 'user')->count();
            if ($ratingcount != 0) {
                return response()->json(['status' => false]);
            } else {
                $rating = new Rating;
                $rating->user_id = auth()->user()->id;
                $rating->realtor_id = $request->realtor_id;
                $rating->rating_stars = $request->star;
                $rating->comment = $request->comment;
                $rating->type = 'user';
                $rating->save();
                return $rating;
            }
        }
    }
    ///  send report  to admin  in realtor in profile page
    public function  add_report(Request $request)
    {
       $report= ReportAdmin::create([
            'user_id'=>auth()->user()->id,
            'report'=>$request->report,
           'realtor_id'=>$request->realtor_id
        ]);
       if ($report)
        Alert::success(trans('frontend.report_send'))->persistent(trans('frontend.close'));

        return redirect()->back();

    }
    ///////get comment by offset and user_id
    public function get_all_comment(Request $request)
    {
        $offset=$request->offset_id;
        $user_id=$request->user_id;

        $comment= Rating::where('realtor_id',$user_id)->where('type', 'user')->skip($offset)->take(10)->get();
        return response()->json(['data'=>$comment]);
    }
    ///// comment  page  from profile page user
    public function get_all_comment_view($id)
    {
        $rating = Rating::where('realtor_id', $id)->where('type', 'admin')->get();
        $rating_time = floatval($rating->avg('rating_stars'));
        $rating2 = Rating::where('realtor_id', $id)->where('type', 'user')->get();
        $rating_time_user = floatval($rating2->avg('rating_stars'));
        $user = User::findOrFail($id);
        return view('frontend.pages.all_comment',compact('id','user', 'rating_time', 'rating_time_user'));
    }
    /// page update profile
    public function edit_profile()
    {
        if (auth()->user()->realtor) {
            $city = City::orderBy('ordering','asc')->get();
            $state = State::orderBy('ordering','asc')->get();
            $id = auth()->user()->id;
            $user = User::findOrFail($id);
            return view('frontend.pages.update_profile', compact('user', 'city', 'state'));
        }
        else
            return redirect()->route('home');

    }
    ///  update profile
    public function updatet_profile(UpdateProfileRequest $request)
    {
        $id= auth()->user()->id;
        $user=User::findOrFail($id);
        $user->name        = $request->name;
        $user->email       = $request->email;
        $user->phone       = $request->phone;
        $user->image       = Helper::UpdateImage($request,'uploads/avatars/','image',$user->image);
        $user->state_id    = $request->state_id;
        $user->city_id     = $request->city_id;

        if (isset($request->password))
            $user->password = bcrypt($request->password);
        $user->save();
        $user->realtor->update([
            'bio'         =>$request->bio,
            'phone1'      =>$request->phone1,
            'phone2'      =>$request->phone2,
            'phone3'      =>$request->phone3,
            'address'     =>$request->address,
            'company_name'=>$request->company_name,
        ]);

        Alert::success(trans('backend.updateFash'))->persistent(trans('frontend.close'));
        return redirect()->route('get_profile_view',$id);
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
