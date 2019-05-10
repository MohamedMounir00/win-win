<?php

namespace App\Http\Controllers\Backend;

use App\ContactUs;
use App\Http\Requests\Backend\DataRequest;
use App\ReportAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class MessageController extends Controller
{

    public function index()
    {


        return view('backend.message.index');
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
        $data = ContactUs::findOrFail($id);
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
        $data = ContactUs::get();

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                if ($data->seen==0)
                {
                    return '
              <button class="btn btn-delete btn btn-round  btn-danger" data-remote="message/' . $data->id . '">'.trans('backend.unseen').'</button>
    
                ';
                }
                else{
                    return '
              <button class="btn btn-delete btn btn-round  btn-success" data-remote="message/' . $data->id . '">'.trans('backend.seen').'</button>
    
                ';
                }
            })

            ->addColumn('name', function ($data) {
                return$data->name;
            })
            ->addColumn('email', function ($data) {
                return$data->email;
            })
            ->addColumn('phone', function ($data) {
                return $data->phone;
            })
            ->addColumn('report', function ($data) {
                return $data->message ;
            })

            ->rawColumns(['action', 'name','email','message','phone'])
            ->make(true);
    }
}
