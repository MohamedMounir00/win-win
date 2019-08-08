<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\Helper;
use App\City;
use App\Http\Requests\Frontend\AddUnitRequest;
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

class MainUnitController extends Controller
{
    //
    public function __construct()
    {
       // $this->middleware('NotActive');

    }
    /// get data for  add unit
    public function get_data_view()
    {

        if(auth()->user()->realtor) {
            $type = Type_estate::all();
            $city = City::orderBy('ordering','asc')->get();
            $state = State::orderBy('ordering','asc')->get();
            $last_units = Unit::where('user_id', auth()->user()->id)->latest()->take(10)->get();
            return view('frontend.pages.add_unit', compact('type', 'city', 'state', 'last_units'));
        }
        else
            return redirect()->route('home');
    }
    ///add unit
    public function AddUnit(AddUnitRequest $request)
    {
        $photos = explode(',', $request->photos);

        $unit = new Unit();
        $unit->title = $request->title;
        $unit->desc = $request->desc;
        $unit->type_id = $request->type_id;
        $unit->rooms = $request->rooms;
        $unit->price = $request->price;
        if ( in_array($request->floor, Helper::floor()))
            $unit->floor = $request->floor;
        $unit->area = $request->area;
        $unit->bathroom = $request->bathroom;
        $unit->status = $request->status;
        $unit->finishing = $request->finishing;
        $unit->payment_method = $request->payment_method;
        $unit->city_id = $request->city_id;
        $unit->state_id = $request->state_id;
        $unit->user_id = auth()->user()->id;

        if ($request->photos == null)
        {
         //   $image=imageModel::create([
                //'url'=>'uploads/units/img-bgh-dsd-1562519339849905729.JPG'
         //   ]);
          //  $unit->image_id=$image->id;

        }

        else

        $unit->image_id=$photos[0];
        $unit->save();
        if ($request->photos != null)
            $unit->storge()->sync($photos);
      //  else
          //  $unit->storge()->sync($image->id);

        if ($unit)
            Alert::success(trans('frontend.add_unit_sucess'))->persistent(trans('frontend.close'));

        return redirect()->route('get_data_view');

    }
    // edit unit view inside page   after active  user
    public function edit_unit_wiew($id)
    {
        if(auth()->user()->realtor)
        {
            $unit = Unit::findOrFail($id);
            if ($unit->user_id!=auth()->user()->id)
                return redirect()->route('home');

            $type = Type_estate::all();
            $city = City::orderBy('ordering','asc')->get();
            $state = State::orderBy('ordering','asc')->get();
            return view('frontend.pages.edit_unit', compact('type', 'city', 'state','unit'));
        }

        else
        return redirect()->route('home');

    }
       public function edit_unit_wiew2($id)
    {

        $unit = Unit::findOrFail($id);
        if (auth()->user()->admins)
        {
            $type = Type_estate::all();
            $city = City::all();
            $state = State::all();
            return view('frontend.pages.edit_unit', compact('type', 'city', 'state','unit'));
        }
        else
            return redirect()->route('home');






    }
    // update unit inside page after active user
    public function UpdateUnit(AddUnitRequest $request,$id)
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
        if ($total>8){
            Alert::success(trans('frontend.you_can_upload_image_more'))->persistent(trans('frontend.close'));
            return back();
        }
        $allQuestions = Question::all();
        $type=Type_estate::find($request->type_id)->questions;
        $data=[];
        if(in_array($unit->image_id, $photos_del)) {
            $data['image_id'] = null;
        }
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
            if ($value->key == "floor") {
                if (in_array(request($value->key), Helper::floor()))
                    $data[$value->key]= request($value->key);
            }else {
                $data[$value->key]= request($value->key);
            }
        }
$unit->update($data);

        if ($request->photos != null)
            $unit->storge()->syncWithoutDetaching($photos);
        $photos_del = explode(',', $request->photos_remove);

        if ($request->photos_remove != null) {
            foreach ($photos_del as $photos) {

                $image = Image::find($photos);
               
                if (File::exists(public_path($image->url))) { // unlink or remove previous image from folder
                    unlink(public_path($image->url));
                }
                $image->delete();
                //$image_rel = Image_rel::where('image_id', $photos)->first();
               // $image_rel->delete();
            }
        }

        
        if ($unit)
            Alert::success(trans('frontend.update_unit_sucess'))->persistent(trans('frontend.close'));

        return redirect()->route('details',$id);

    }
        public function destroy($id)
    {
        $data = Unit::findOrFail($id);
        $data->delete();
        Alert::success(trans('backend.deleteFlash'))->persistent("Close");
        if( auth()->user()->verification==false)
                return redirect('/');
                else
        return redirect()->route('home');

    }



}
