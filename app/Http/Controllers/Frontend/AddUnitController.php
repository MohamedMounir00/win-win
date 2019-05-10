<?php

namespace App\Http\Controllers\Frontend;

use App\City;
use App\Http\Requests\Frontend\AddUnitRequest;
use App\Http\Resources\Frontend\UnitCollection;
use App\Image;
use App\Image_rel;
use App\Question;
use App\State;
use App\Type_estate;
use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;
use Illuminate\Support\Facades\File;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AddUnitController extends Controller
{
    //

    public function __construct()
    {


       $this->middleware('active')->except('getInputByType', 'change_status','get_all_units');
        $this->middleware('auth')->except('getInputByType', 'change_status','get_all_units');

    }


    public function get_unit_view()
    {
        $count =Unit::where('user_id',auth()->user()->id)->count();
        if ($count >=10)
            return redirect()->route('thank-you-page');
        else {
            $type = Type_estate::all();
            $city = City::all();
            $state = State::all();
            return view('frontend.main.add_unit', compact('type', 'city', 'state'));
        }
    }

    ///add unit
    public function AddUnit(AddUnitRequest $request)
    {
       $count =Unit::where('user_id',auth()->user()->id)->count();
         if ($count >=10)
    return redirect()->route('thank-you-page');
    else {
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
        Alert::success(trans('frontend.add_unit_sucess'))->persistent(trans('frontend.close'));

    return redirect()->route('add-unit-page');
         }
    }
    public function all_my_units_view()
    {
        $units = Unit::with('unit_type', 'state', 'city', 'storge')->where('user_id', auth()->user()->id)->get();


        return view('frontend.main.all_my_units', compact('units'));
    }

    public function all_my_units(Request $request)
    {
        $id = $request->id;
        if ($id == '')
            $unit = Unit::where('user_id', auth()->user()->id)->first();

        else
            $unit = Unit::where('user_id', auth()->user()->id)->findOrFail($id);
        return new UnitCollection($unit);
    }

    public function getInputByType($id)
    {
        $type = Type_estate::find($id);
        $questions = $type->questions;
        return response()->json(['questions' => $questions]);

    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $activation = $request->activation;
        $unit = Unit::findOrFail($id);
        $unit->activation_user = $activation;
        $unit->save();
        return response()->json(['activation' => $unit->activation_user,'id'=>$id]);

    }
    ///////get units by offset and user_id
    public function get_all_units(Request $request)
    {

        $offset=$request->offset_id;
        $user_id=$request->user_id;
        if (auth()->user()->id == $user_id)
            $units = Unit::where('user_id', $user_id)->skip($offset)->take(10)->get();
        else
            $units= Unit::where('user_id',$user_id)->where('activation_admin', 'active')->where('activation_user', 'active')->skip($offset)->take(10)->get();
        return  UnitCollection::collection($units);
    }
    public function get_unit_edit_view($id)
    {
        if(auth()->user()->realtor)
        {
            $unit = Unit::findOrFail($id);
            if ($unit->user_id!=auth()->user()->id)
                return redirect()->route('/');

            $type = Type_estate::all();
            $city = City::all();
            $state = State::all();
            return view('frontend.main.edit_unit', compact('type', 'city', 'state','unit'));
        }

        else
            return redirect('/');
    }

    public function UpdateUnit_out(AddUnitRequest $request,$id)
    {
        $photos_del = [];
        if ($request->photos_remove != null) {
            $photos_del = explode(',', $request->photos_remove);
        }
        $photos = [];
        if ($request->photos != null) {
            $photos = explode(',', $request->photos);
        }

        $unit =  Unit::find($id);
        $count_curent= Image_rel::where('uint_id', $id)->count();
        $new_count=sizeof($photos);
        $count_remove=sizeof($photos_del);
        $total=($new_count+$count_curent)-$count_remove;

        if ($total<=0){
            Alert::success(trans('frontend.you_cant_remove_image'))->persistent(trans('frontend.close'));
            return back();
        }
        $allQuestions = Question::all();
        $type=Type_estate::find($request->type_id)->questions;
        $data=[];
        $data['title'] = $request->title;
        $data['desc'] = $request->desc;
        $data['type_id'] = $request->type_id;
        /// delete old data brfor update
        /// // get difrent data from old
        foreach (collect($allQuestions)->diff($type) as $value)
        {
            $data[$value->key]= null;
        }
        foreach ($type  as $value) {
            $data[$value->key]= request($value->key);
        }
        $unit->update($data);

        $photos = explode(',', $request->photos);
        if ($request->photos != null)
            $unit->storge()->syncWithoutDetaching($photos);
        if ($request->photos_remove != null) {
            foreach ($photos_del as $photos) {
                $image = Image::find($photos);
                if (File::exists(public_path($image->url))) { // unlink or remove previous image from folder
                    unlink(public_path($image->url));
                }
                $image->delete();
           //     $image_rel = Image_rel::where('image_id', $photos)->first();
               // $image_rel->delete();
            }
        }
        if ($unit)
            Alert::success(trans('frontend.update_unit_sucess'))->persistent(trans('frontend.close'));

        return redirect('/');

    }

}
