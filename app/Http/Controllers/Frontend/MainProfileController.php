<?php

namespace App\Http\Controllers\Frontend;

use App\Rating;
use App\ReportAdmin;
use App\Unit;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;

class MainProfileController extends Controller
{
    //
    public function __construct()
    {


      //  $this->middleware('active')->except('getInputByType', 'change_status');
        $this->middleware('auth');

    }


    public function profile($id)
    {
        $ratingcount = Rating::where('realtor_id', $id)->where('user_id', auth()->user()->id)->where('type', 'user')->count();
        $ratingme = Rating::where('realtor_id', $id)->where('user_id', auth()->user()->id)->where('type', 'user')->first();

        $rating = Rating::where('realtor_id', $id)->where('type', 'admin')->get();
        $rating_time = floatval($rating->avg('rating_stars'));
        $rating2 = Rating::where('realtor_id', $id)->where('type', 'user')->get();
        $rating_time_user = floatval($rating2->avg('rating_stars'));
        $user = User::findOrFail($id);
        $units = Unit::where('user_id', $id)->where('activation_admin', 'active')->where('activation_user', 'active')->get();
        $rating_10= Rating::where('realtor_id', $id)->where('type', 'user')->take(10)->get();

        return view('frontend.pages.profile', compact('user', 'units', 'rating_time', 'rating_time_user', 'rating2', 'ratingcount', 'ratingme','rating_10'));
    }


    public function addRating(Request $request)
    {
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
}
