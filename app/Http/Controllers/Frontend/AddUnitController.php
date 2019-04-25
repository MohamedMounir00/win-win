<?php

namespace App\Http\Controllers\Frontend;

use App\City;
use App\Http\Requests\Frontend\AddUnitRequest;
use App\Http\Resources\Frontend\UnitCollection;
use App\Image_rel;
use App\State;
use App\Type_estate;
use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;

class AddUnitController extends Controller
{
    //

    public function __construct()
    {


        $this->middleware('active')->except('getInputByType','change_status');
       $this->middleware('auth')->except('getInputByType','change_status');

    }



    public function get_unit_view()
    {
        $type= Type_estate::all();
        $city=City::all();
        $state=State::all();
        return view('frontend.main.add_unit',compact('type','city','state'));
    }
    ///add unit
    public function AddUnit(Request $request)
    {
        //return$request->all();

        $unit= new Unit();
        $unit->title=$request->title;
        $unit->desc=$request->desc;
        $unit->type_id=$request->type_id;
        $unit->rooms=$request->rooms;
        $unit->price=$request->price;
        $unit->floor=$request->floor;
        $unit->area=$request->area;
        $unit->bathroom=$request->bathroom;

              $unit->status=$request->status;






            $unit->finishing=$request->finishing;



            $unit->payment_method = $request->payment_method;


            $unit->city_id=$request->city_id;


            $unit->state_id=$request->state_id;

        $unit->user_id=auth()->user()->id;
        $unit->save();


          $photos=explode(',', $request->photos);
           if ($request->photos!=null)
          $unit->storge()->sync($photos);
   if ($unit)
    Alert::success(trans('backend.created'))->persistent("Close");

        return redirect()->route('add-unit-page');

    }

    public function all_my_units_view()
    {
        $units=Unit::with('unit_type','state','city','storge')->where('user_id',auth()->user()->id)->get();


        return view('frontend.main.all_my_units',compact('units'));
    }
    public function all_my_units(Request $request)
    {
        $id=$request->id;
        if ($id=='')
            $unit=Unit::where('user_id',auth()->user()->id)->first();

        else
            $unit=Unit::where('user_id',auth()->user()->id)->findOrFail($id);
        return  new UnitCollection($unit);
    }

    public  function getInputByType($id)
    {
        $type = Type_estate::find($id);
        $questions= $type->questions;
        return response()->json(['questions'=>$questions]);

    }
public  function change_status(Request $request)
{
    $id =$request->id;
    $activation =$request->activation;
    $unit=Unit::findOrFail($id);
    $unit->activation_user=$activation;
    $unit->save();
    return response()->json(['activation'=>$unit->activation_user]);

}
}
