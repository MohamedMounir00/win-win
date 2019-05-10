<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Frontend\AddUnitRequest;
use App\Http\Resources\Api\StatusCollection;
use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnitsController extends Controller
{
    public function AddUnit(AddUnitRequest $request)
    {
        $lang =$request->lang;

        $count =Unit::where('user_id',auth()->user()->id)->count();
        if (auth()->user()->verification==false)
        if ($count >=10)
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
}
