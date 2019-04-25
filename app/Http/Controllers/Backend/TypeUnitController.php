<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\dataRequest;
use App\Question;
use App\Question_rel;
use App\Type_estate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Yajra\Datatables\Datatables;
use Alert;
use DB;
class TypeUnitController extends Controller
{
    //




    public function index()
    {


        return view('backend.type_unit.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $questions=Question::all();
        return view('backend.type_unit.create',compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(DataRequest $request)
    {

        $c= Type_estate::create(['name' => serialize($request->name)]);
        $c->questions()->sync($request->q_id);
        if ($c)
            Alert::success(trans('backend.created'))->persistent("Close");

        return redirect()->route('type_unit.index');

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
        $questions=Question::all();

        $data = Type_estate::findOrFail($id);
        $rel_q = DB::table("question_rels")->where("question_rels.type_id",$id)
            ->pluck('question_rels.q_id','question_rels.q_id')
            ->all();


        return view('backend.type_unit.edit', compact('data','rel_q','questions'));

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

        $data = Type_estate::findOrFail($id);

        $data->update(['name' => serialize($request->name)]);
        $data->questions()->sync($request->q_id);

        if ($data)
            Alert::success(trans('backend.updateFash'))->persistent("Close");
        return redirect()->route('type_unit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Type_estate::findOrFail($id);

        $data->delete();
        Alert::success(trans('backend.deleteFlash'))->persistent("Close");

        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }




    public function getAnyDate()
    {
        $data = Type_estate::all();

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '<a href="' . route('type_unit.edit', $data->id) . '" class="btn btn-round  btn-primary"><i class="fa fa-edit"></i> '.trans('backend.update').'</a>
              <button class="btn btn-delete btn btn-round  btn-danger" data-remote="type_unit/' . $data->id . '"><i class="fa fa-remove"></i>'.trans('backend.delete').'</button>
    
                ';
            })
            ->addColumn('name', function ($data) {
                return unserialize($data->name)[LaravelLocalization::getCurrentLocale()];

            })

            ->rawColumns(['action', 'name'])
            ->make(true);
    }





}
