<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\RatingCollection;
use App\Http\Resources\Api\StatusCollection;
use App\Rating;
use App\ReportAdmin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataProfileController extends Controller
{
    // add rating foe realtor  from user or admin

    public function addRating(Request $request)
    {
        $lang = $request->lang;

        if (auth()->user()->admins) {
            $rating = new Rating;
            $rating->user_id = auth()->user()->id;
            $rating->realtor_id = $request->realtor_id;
            $rating->rating_stars = $request->star;
            $rating->comment = $request->comment;
            $rating->type = 'admin';
            $rating->save();
            return new RatingCollection($rating);
        } else {
            $ratingcount = Rating::where('realtor_id', $request->realtor_id)->where('user_id', auth()->user()->id)->where('type', 'user')->count();
            if ($ratingcount != 0) {
                return (new StatusCollection(false, trans('api.can_not_rating', [], $lang)))->response()
                    ->setStatusCode(400);
            } else {
                $rating = new Rating;
                $rating->user_id = auth()->user()->id;
                $rating->realtor_id = $request->realtor_id;
                $rating->rating_stars = $request->star;
                $rating->comment = $request->comment;
                $rating->type = 'user';
                $rating->save();
                return new RatingCollection($rating);
            }
        }
    }
      /// send report from realtor to admin
    public function  add_report(Request $request)
    {
        $lang = $request->lang;

        $report= ReportAdmin::create([
            'user_id'=>auth()->user()->id,
            'report'=>$request->report,
            'realtor_id'=>$request->realtor_id
        ]);


        return (new StatusCollection(true, trans('frontend.report_send', [], $lang)))->response()
            ->setStatusCode(201);
    }

    ///////get comment by offset and user_id
    public function get_all_comment(Request $request)
    {
        $offset=$request->offset_id;
        $user_id=$request->user_id;

        $comment= Rating::where('realtor_id',$user_id)->where('type', 'user')->skip($offset)->take(10)->get();
        return RatingCollection::collection($comment);
    }


}
