<?php

namespace App\Http\Controllers\Frontend;

use App\City;
use App\Http\Resources\Frontend\UnitCollection;
use App\Rating;
use App\State;
use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class SearchController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth')->except('advanced_search');
        $this->middleware('NotActive')->except('advanced_search');

    }

    public function search_view(Request $request)
    {
      //$units = $this->searchOperation($request)->get();
        $search_title=$request->title;
        //dd($units);
        $city=City::all();
        $state=State::all();
        return view('frontend.pages.search',compact('search_title','city','state'));
    }

    public function advanced_search(Request $request)
    {
        $units = $this->searchOperation($request)->get();
        return UnitCollection::collection($units) ;
    }

    public function searchOperation(Request $request) {

        $units=Unit::where('activation_admin','active')->whereHas('realtor', function ($query) {
            $query->where('verification',true);
        });
        if ($request->title != null)
            $units -> where('title','LIKE','%'.$request->title.'%');
        if ($request->status != null)
            $units->where('status', $request->status);
        if ($request->finishing != null)
            $units->where('finishing', $request->finishing);
        if ($request->city != null)
            $units->where('city_id', $request->city);
        if ($request->state != null)
            $units->where('state_id', $request->state);
        if ($request->bedrooms_from != null)
            $units->where('rooms','>=', $request->bedrooms_from);
        if ($request->bedrooms_to != null)
            $units->where('rooms','<=', $request->bedrooms_to);
        if ($request->floor_from != null)
            $units->where('floor','>=', $request->floor_from);
        if ($request->floor_to != null)
            $units->where('floor','<=', $request->floor_to);
        if ($request->price_from != null)
            $units->where('price','>=', $request->price_from);
        if ($request->price_to != null)
            $units->where('price','<=', $request->price_to);
        if ($request->area_from != null)
            $units->where('area','>=', $request->area_from);
        if ($request->area_to != null)
            $units->where('area','<=', $request->area_to);

        $units->orderBy('created_at','desc');
        $units->skip($request->offset_id)->take(10);

        return $units;
    }
    public  function  unit_details($id)
    {
        $unit= Unit::findOrFail($id);

        $rating= Rating::where('realtor_id',$unit->user_id)->where('type','admin')->get();
        $rating_time=floatval($rating->avg('rating_stars'));
        $rating2= Rating::where('realtor_id',$unit->user_id)->where('type','user')->get();
        $rating_time_user=floatval($rating2->avg('rating_stars'));
        return view('frontend.pages.unit_details',compact('unit','rating_time','rating_time_user'));
    }

}
