<?php

namespace App\Http\Controllers\Frontend;

use App\City;
use App\Http\Resources\Frontend\UnitCollection;
use App\Rating;
use App\State;
use App\Type_estate;
use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class SearchController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth')->except('advanced_search','choose_image');
        $this->middleware('NotActive')->except('advanced_search','choose_image','unit_details');

    }
     /// search view
    public function search_view(Request $request)
    {
      //$units = $this->searchOperation($request)->get();
        $search_title=$request->title;
        //dd($units);
        $city=City::orderBy('ordering','asc')->get();
        $state=State::orderBy('ordering','asc')->get();
        $type = Type_estate::all();
        return view('frontend.pages.search',compact('search_title','city','state','type'));
    }

    public function advanced_search(Request $request)
    {
        $units = $this->searchOperation($request)->get();
        return UnitCollection::collection($units) ;
    }
    public function searchOperation(Request $request) {
       $name= $request->title;
        $units=Unit::where('activation_admin','active')->where('activation_user','active')->whereHas('realtor', function ($query) {
            $query->where('verification','1');
        });
        if ($request->title != null)
            $units -> where('title','LIKE','%'.$request->title.'%')->orWhere('desc','LIKE','%'.$request->title.'%')
                ->orWhereHas('realtor', function( $query ) use ( $name ){
                    $name;
                    $query->whereHas('realtor', function ($query) use ( $name ) {
                        $query->where('company_name','LIKE','%'.$name.'%');
                    });
            });
        if ($request->status != null)
            $units->where('status', $request->status);
        if ($request->finishing != null)
            $units->where('finishing', $request->finishing);
        if ($request->city != null)
            $units->where('city_id', $request->city);
        if ($request->type_id != null)
            $units->where('type_id', $request->type_id);
        if ($request->state != null)
            $units->where('state_id', $request->state);
        if ($request->bedrooms_from != null)
            $units->where('rooms','>=', $request->bedrooms_from);
        if ($request->bedrooms_to != null)
            $units->where('rooms','<=', $request->bedrooms_to);
        if ($request->floor != null) {
            if ($request->floor == 'ارضى' || $request->floor == 'ground') {
                $units->where('floor', 'ارضى');
                $units->orWhere('floor', 'ground');
            }
            else if ($request->floor == 'بيزمينت' || $request->floor == 'Bizment') {
                $units->where('floor', 'بيزمينت');
                $units->orWhere('floor', 'Bizment');
            }
            else if ($request->floor == 'روف' || $request->floor == 'Roof') {
                $units->where('floor', 'روف');
                $units->orWhere('floor', 'Roof');
            } else
                $units->where('floor', $request->floor);
        }
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
        if (auth()->user()->id!=$unit->user_id&&auth()->user()->verification==false)
            return  redirect()->route('get_profile_view',auth()->user()->id);
        $rating= Rating::where('realtor_id',$unit->user_id)->where('type','admin')->get();
        $rating_time=floatval($rating->avg('rating_stars'));
        $rating2= Rating::where('realtor_id',$unit->user_id)->where('type','user')->get();
        $rating_time_user=floatval($rating2->avg('rating_stars'));
        return view('frontend.pages.unit_details',compact('unit','rating_time','rating_time_user'));
    }
public  function choose_image(Request $request)
{
    $id_image=$request->image_id;
    $id_unit=$request->unit_id;
    $unit= Unit::find($id_unit);
    $unit->image_id=$id_image;
    $unit->save();
    return response()->json(['status'=>true]);

}
}
