<?php

namespace App\Http\Controllers\Frontend;

use App\City;
use App\State;
use App\Type_estate;
use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;

class MainUnitController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('NotActive');

    }



    public function get_data_view()
    {


        $type = Type_estate::all();
        $city = City::all();
        $state = State::all();
        $last_units=Unit::where('user_id',auth()->user()->id)->latest()->take(10)->get();
        return view('frontend.pages.add_unit', compact('type', 'city', 'state','last_units'));
    }

    ///add unit
    public function AddUnit(Request $request)
    {
        //return$request->all();

        $unit = new Unit();
        $unit->title = $request->title;
        $unit->desc = $request->desc;
        $unit->type_id = $request->type_id;
        $unit->rooms = $request->rooms;
        $unit->price = $request->price;
        $unit->floor = $request->floor;
        $unit->area = $request->area;
        $unit->bathroom = $request->bathroom;
        $unit->status = $request->status;
        $unit->finishing = $request->finishing;
        $unit->payment_method = $request->payment_method;
        $unit->city_id = $request->city_id;
        $unit->state_id = $request->state_id;
        $unit->user_id = auth()->user()->id;
        $unit->save();
        $photos = explode(',', $request->photos);
        if ($request->photos != null)
            $unit->storge()->sync($photos);
        if ($unit)
            Alert::success(trans('backend.created'))->persistent("Close");

        return redirect()->route('get_data_view');

    }



}
