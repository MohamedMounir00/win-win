<?php

namespace App\Http\Controllers\Backend;

use App\City;
use App\Http\Requests\Backend\DataRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Yajra\Datatables\Datatables;
use Alert;
class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    return view('backend.cities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('backend.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(DataRequest $request)
    {

        $c= City::create(['name' => serialize($request->name),'ordering'=>$request->ordering]);
        if ($c)
            Alert::success(trans('backend.created'))->persistent("Close");

        return redirect()->route('cities.index');

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

        $data = City::findOrFail($id);

        return view('backend.cities.edit', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(DataRequest $request, $id)
    {

        $data = City::findOrFail($id);

        $data->update(['name' => serialize($request->name),'ordering'=>$request->ordering]);

        if ($data)
            Alert::success(trans('backend.updateFash'))->persistent("Close");
        return redirect()->route('cities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = City::findOrFail($id);

        $data->delete();
        Alert::success(trans('backend.deleteFlash'))->persistent("Close");

        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }




    public function getAnyDate()
    {
        $data = City::orderBy('ordering','asc')->get();

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '<a href="' . route('cities.edit', $data->id) . '" class="btn btn-round  btn-primary"><i class="fa fa-edit"></i> '.trans('backend.update').'</a>
              <button class="btn btn-delete btn btn-round  btn-danger" data-remote="cities/' . $data->id . '"><i class="fa fa-remove"></i>'.trans('backend.delete').'</button>
    
                ';
            })
            ->addColumn('name', function ($data) {
                return unserialize($data->name)[LaravelLocalization::getCurrentLocale()];

            })

            ->rawColumns(['action', 'name'])
            ->make(true);
    }


}
