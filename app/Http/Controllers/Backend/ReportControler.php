<?php

namespace App\Http\Controllers\Backend;

use App\City;
use App\Http\Requests\Backend\DataRequest;
use App\ReportAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Yajra\DataTables\DataTables;

class ReportControler extends Controller
{
    //


    public function index()
    {


        return view('backend.report.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(DataRequest $request)
    {


    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(DataRequest $request, $id)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ReportAdmin::findOrFail($id);
        if ($data->seen == true) {
            $data->seen = false;
            $data->save();

            Alert::success(trans('backend.update'))->persistent("Close");
        } else {
            $data->seen = true;
            $data->save();

            Alert::success(trans('backend.update'))->persistent("Close");


        }

        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }


    public function getAnyDate()
    {
        $data = ReportAdmin::get();

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                if ($data->seen==0)
                {
                    return '
              <button class="btn btn-delete btn btn-round  btn-danger" data-remote="report/' . $data->id . '">'.trans('backend.unseen').'</button>
    
                ';
                }
                else{
                    return '
              <button class="btn btn-delete btn btn-round  btn-success" data-remote="report/' . $data->id . '">'.trans('backend.seen').'</button>
    
                ';
                }
            })

            ->addColumn('name', function ($data) {
                return'<a href="' . route('realtor.show', $data->user_id) . '">'.$data->user->name.'</a>';
            })
            ->addColumn('email', function ($data) {
                return'<a href="' . route('realtor.show', $data->user_id) . '">'.$data->user->email.'</a>';
            })
            ->addColumn('phone', function ($data) {
                return $data->user->phone;
            })
            ->addColumn('report', function ($data) {
                return $data->report ;
            })
            ->addColumn('realtor', function ($data) {
                return'<a href="' . route('realtor.show', $data->realtor_id) . '">'.$data->realtor->name.'</a>';
            })
            ->rawColumns(['action', 'name','email','report','phone','realtor'])
            ->make(true);
    }

}
