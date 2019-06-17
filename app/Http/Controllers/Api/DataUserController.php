<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Http\Resources\Api\CityCollection;
use App\Http\Resources\Api\TypeWithCityCollection;
use App\Type_estate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataUserController extends Controller
{
    // cites
    public function  get_cites(Request $request)
    {
        $city= City::all();
        return CityCollection::collection($city);

    }
     //////////// get  city and type  in one services for add and uodate unit
    public function get_data_for_unit(Request $request)
    {
        $type = Type_estate::all();

        $city= City::all();

        return new TypeWithCityCollection($city,$type);

    }
    /// get question by  type id
    public function getInputByType($id)
    {
        $type = Type_estate::find($id);
        $questions = $type->questions;
        return response()->json(['questions' => $questions]);

    }

    public function floor(Request $request)
    {
        $lang=$request->lang;
        $floor=[trans('frontend.ground', [], $lang),trans('frontend.bizment', [], $lang),trans('frontend.roof'),
            1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30];
        return response()->json(['questions' => $floor]);
    }

}
