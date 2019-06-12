<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Http\Requests\Frontend\AddUnitRequest;
use App\Http\Resources\Api\StatusCollection;
use App\Http\Resources\Api\UnitCollection;
use App\Http\Resources\Api\UnitUpdateCollection;
use App\Image;
use App\Image_rel;
use App\Question;
use App\State;
use App\Type_estate;
use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class UnitsController extends Controller
{
     //// add unit
    public function AddUnit(AddUnitRequest $request)
    {
        $lang = $request->lang;

        if (auth()->user()->register=='second_step' ) {

            $count = Unit::where('user_id', auth()->user()->id)->count();
            if (auth()->user()->verification == false)
                if ($count >= 10)
                    return (new StatusCollection(false, trans('api.can_not_add_more', [], $lang)))->response()
                        ->setStatusCode(400);
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
            return (new StatusCollection(true, trans('frontend.add_unit_sucess', [], $lang)))->response()
                ->setStatusCode(201);
        }
        else{
            return (new StatusCollection(false, trans('api.no_permission', [], $lang)))->response()
                ->setStatusCode(400);
        }
    }
       /// all my units outside page only -- when user not active
    public function all_my_units(Request $request)
    {
        $lang = $request->lang;

        if (auth()->user()->verification==0 &&auth()->user()->register=='second_step' )
       {
            $units = Unit::where('user_id', auth()->user()->id)->get();

            return  UnitCollection::collection($units)->response()
                ->setStatusCode(201);
       }

        else{
            return (new StatusCollection(false, trans('api.no_permission', [], $lang)))->response()
                ->setStatusCode(400);

        }

    }
     // get details unit by id or first unit when not send id for my units outside page
    public function get_unit_details(Request $request)
    {
        $id = $request->unit_id;
        if ($id == '')
            $unit = Unit::where('user_id', auth()->user()->id)->first();

        else
            $unit = Unit::where('user_id', auth()->user()->id)->findOrFail($id);
        return new UnitCollection($unit);
    }
     /// change status  my unit active or not active
    public function change_status(Request $request)
    {
        $lang=$request->lang;
        $id = $request->id;
        $activation = $request->activation;
        $unit = Unit::where('user_id',auth()->user()->id)->find($id);
        if (isset($unit)) {
            $unit->activation_user = $activation;
            $unit->save();
            return response()->json(['activation' => $unit->activation_user, 'id' => $id]);
        }else
        return (new StatusCollection(false, trans('api.no_permission', [], $lang)))->response()
            ->setStatusCode(400);

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
    ///get data unit by id and  for update
    public function get_unit_edit(Request $request)
    {
        $lang=$request->lang;
        $id=$request->id;
        if(auth()->user()->realtor)
        {
            $unit = Unit::where('user_id',auth()->user()->id)->find($id);
            if (!$unit)
                return (new StatusCollection(false, trans('api.no_permission', [], $lang)))->response()
                    ->setStatusCode(400);
            $type = Type_estate::all();
            $city = City::all();

            return  new UnitUpdateCollection($type,$city,$unit);
        }

        else
            return (new StatusCollection(false, trans('api.no_permission', [], $lang)))->response()
                ->setStatusCode(400);
    }
      /////update unit by unit id
    public function UpdateUnit(AddUnitRequest $request)
    {
        $lang = $request->lang;

        if (auth()->user()->register=='second_step' ) {

            $id = $request->unit_id;
            $unit = Unit::where('user_id', auth()->user()->id)->find($id);
            if (!$unit)
                return (new StatusCollection(false, trans('api.no_permission', [], $lang)))->response()
                    ->setStatusCode(400);
            $photos_del = [];
            if ($request->photos_remove != null) {
                $photos_del = explode(',', $request->photos_remove);
            }
            $photos = [];
            if ($request->photos != null) {
                $photos = explode(',', $request->photos);
            }

            $count_curent = Image_rel::where('uint_id', $id)->count();
            $new_count = sizeof($photos);
            $count_remove = sizeof($photos_del);
            $total = ($new_count + $count_curent) - $count_remove;

            if ($total <= 0)
                return (new StatusCollection(false, trans('frontend.you_cant_remove_image', [], $lang)))->response()->setStatusCode(400);

            $allQuestions = Question::all();
            $type = Type_estate::find($request->type_id)->questions;
            $data = [];
            $data['title'] = $request->title;
            $data['desc'] = $request->desc;
            $data['type_id'] = $request->type_id;
            /// delete old data brfor update
            /// // get difrent data from old
            foreach (collect($allQuestions)->diff($type) as $value) {
                $data[$value->key] = null;
            }
            foreach ($type as $value) {
                $data[$value->key] = request($value->key);
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
                return (new StatusCollection(true, trans('frontend.update_unit_sucess', [], $lang)))->response()
                    ->setStatusCode(201);

        }
        else{
            return (new StatusCollection(false, trans('api.no_permission', [], $lang)))->response()
                ->setStatusCode(400);
        }
    }
    /// for search
    public function advanced_search(Request $request)
    {
        $units = $this->searchOperation($request)->get();
        return UnitCollection::collection($units) ;
    }
    public function searchOperation(Request $request) {

        $units=Unit::where('activation_admin','active')->where('activation_user','active')->whereHas('realtor', function ($query) {
            $query->where('verification','1');
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
    // get last 10 units
    public  function last_units()
    {
        $last_units = Unit::where('user_id', auth()->user()->id)->latest()->take(10)->get();
        return UnitCollection::collection($last_units);
    }
}

