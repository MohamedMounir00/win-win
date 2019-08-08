<?php

namespace App\Http\Controllers\Backend;

use App\City;
use App\Http\Requests\Backend\StatsRequest;
use App\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Yajra\Datatables\Datatables;
use Alert;
class StatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.state.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $city=City::all();

        return view('backend.state.create',compact('city'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatsRequest $request)
    {

        $c= State::create(['name' => serialize($request->name),'city_id'=>$request->city_id,'ordering'=>$request->ordering]);
        if ($c)
            Alert::success(trans('backend.created'))->persistent("Close");

        return redirect()->route('state.index');

    }



    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $city=City::all();

        $data = State::findOrFail($id);

        return view('backend.state.edit', compact('data','city'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StatsRequest $request, $id)
    {

        $data = State::findOrFail($id);

        $data->update(['name' => serialize($request->name),'city_id'=>$request->city_id,'ordering'=>$request->ordering]);

        if ($data)
            Alert::success(trans('backend.updateFash'))->persistent("Close");
        return redirect()->route('state.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = State::findOrFail($id);

        $data->delete();
        Alert::success(trans('backend.deleteFlash'))->persistent("Close");

        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }

    public function getAnyDate()
    {
        $data = State::orderBy('ordering','asc')->get();

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '<a href="' . route('state.edit', $data->id) . '" class="btn btn-round  btn-primary"><i class="fa fa-edit"></i> '.trans('backend.update').'</a>
              <button class="btn btn-delete btn btn-round  btn-danger" data-remote="state/' . $data->id . '"><i class="fa fa-remove"></i>'.trans('backend.delete').'</button>
    
                ';
            })
            ->addColumn('name', function ($data) {
                return unserialize($data->name)[LaravelLocalization::getCurrentLocale()];

            })
            ->addColumn('city', function ($data) {
                return unserialize($data->city->name)[LaravelLocalization::getCurrentLocale()];

            })


            ->rawColumns(['action', 'name','city'])
            ->make(true);
    }


}
