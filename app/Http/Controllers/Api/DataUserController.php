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

}
