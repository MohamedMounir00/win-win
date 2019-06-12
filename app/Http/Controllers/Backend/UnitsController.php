<?php

namespace App\Http\Controllers\Backend;

use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Yajra\Datatables\Datatables;
use Alert;
class UnitsController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.unit.index');
    }

    public function unit_not_active()
    {
        return view('backend.unit.unit_not_active');
    }

    public function get_unit_user_view($id,$status)
    {
        return view('backend.unit.get_unit_user_view',compact('id','status'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {



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
        $data= Unit::findOrFail($id);
        return view('backend.unit.show', compact('data'));

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



        $data = User::findOrFail($id);

        return view('backend.realtor.edit', compact('data','city','state'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


    }
    public function active(Request $request, $id)
    {
        $data = Unit::findOrFail($id);
        if ($data->activation_admin=='active')
        {
            $data->activation_admin='not_active';
            Alert::success(trans('backend.notactive_update'))->persistent("Close");

        }
        else
        {
            $data->activation_admin='active';
            Alert::success(trans('backend.active_update'))->persistent("Close");


        }
       $data->save();
        return back();

    }
    public function activetion(Request $request, $id)
    {
        $data = Unit::findOrFail($id);
        if ($data->activation_admin=='active')
        {
            $data->activation_admin='not_active';

        }
        else
        {
            $data->activation_admin='active';


        }
        $data->save();
        return response()->json([
            'success' => 'unit has been update successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Unit::findOrFail($id);
        $data->delete();
        Alert::success(trans('backend.deleteFlash'))->persistent("Close");

        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }
    /// get all unit    to yjra data table
    public function getAnyDate()
    {
        $data = Unit::get();

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '
                    <a href="' . route('unit.show', $data->id) . '" class="btn btn-round  btn-primary"><i class="fa fa-eye"></i> '.trans('backend.details').'</a>
              <button class="btn btn-delete btn btn-round  btn-danger" data-remote="unit/' . $data->id . '"><i class="fa fa-remove"></i>'.trans('backend.delete').'</button>
    
                ';
            })
            ->addColumn('active', function ($data) {
                if ($data->activation_admin=='not_active')
                {
                    return '
              <button class="btn btn-active btn btn-round  btn-danger" data-remote="unit/activetion/' . $data->id . '">'.trans('backend.not_activation').'</button>
    
                ';
                }
                else{
                    return '
              <button class="btn btn-active btn btn-round  btn-success" data-remote="unit/activetion/' . $data->id . '">'.trans('backend.activation').'</button>
    
                ';
                }
            })
            ->addColumn('state', function ($data) {
                if ($data->state_id==null)
                    return 'لم يتم اختيار منطقه بعد';
                else
                    return unserialize($data->state->name)[LaravelLocalization::getCurrentLocale()];

            })
            ->addColumn('city', function ($data) {
                if ($data->city_id==null)
                    return 'لم يتم اختيار مدينه بعد';
                else
                    return unserialize($data->city->name)[LaravelLocalization::getCurrentLocale()];

            })

                     ->addColumn('type', function ($data) {
                return unserialize($data->unit_type->name)[LaravelLocalization::getCurrentLocale()];

            })
            ->addColumn('realtor', function ($data) {
                return'<a href="' . route('realtor.show', $data->user_id) . '">'.$data->realtor->name.'</a>';
            })

            ->addColumn('title', function ($data) {
                return'<a href="' . route('unit.show', $data->id) . '">'.$data->title.'</a>';
            })
            ->rawColumns(['action', 'state','city','type','realtor','title','active'])
            ->make(true);
    }
    /// get unit not active
    public function getNotActive()
    {
        $data = Unit::where('activation_admin','not_active')->get();

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '
                    <a href="' . route('unit.show', $data->id) . '" class="btn btn-round  btn-primary"><i class="fa fa-eye"></i> '.trans('backend.details').'</a>
              <button class="btn btn-delete btn btn-round  btn-danger" data-remote="unit/' . $data->id . '"><i class="fa fa-remove"></i>'.trans('backend.delete').'</button>
    
                ';
            })
            ->addColumn('active', function ($data) {
                if ($data->activation_admin=='not_active')
                {
                    return '
              <button class="btn btn-active btn btn-round  btn-danger" data-remote="unit/activetion/' . $data->id . '">'.trans('backend.not_activation').'</button>
    
                ';
                }
                else{
                    return '
              <button class="btn btn-active btn btn-round  btn-success" data-remote="unit/activetion/' . $data->id . '">'.trans('backend.activation').'</button>
    
                ';
                }
            })
            ->addColumn('state', function ($data) {
                if ($data->state_id==null)
                    return 'لم يتم اختيار منطقه بعد';
                else
                    return unserialize($data->state->name)[LaravelLocalization::getCurrentLocale()];

            })
            ->addColumn('city', function ($data) {
                if ($data->city_id==null)
                    return 'لم يتم اختيار مدينه بعد';
                else
                    return unserialize($data->city->name)[LaravelLocalization::getCurrentLocale()];

            })

            ->addColumn('type', function ($data) {
                return unserialize($data->unit_type->name)[LaravelLocalization::getCurrentLocale()];

            })
            ->addColumn('realtor', function ($data) {
                return'<a href="' . route('realtor.show', $data->user_id) . '">'.$data->realtor->name.'</a>';
            })

            ->addColumn('title', function ($data) {
                return'<a href="' . route('unit.show', $data->id) . '">'.$data->title.'</a>';
            })
            ->rawColumns(['action', 'state','city','type','realtor','title','active'])
            ->make(true);
    }
    // get unit active or not active  for user
    public function get_unit_user($id,$status)
    {
        $data = Unit::where('user_id',$id)->where('activation_admin',$status)->get();

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '
                    <a href="' . route('unit.show', $data->id) . '" class="btn btn-round  btn-primary"><i class="fa fa-eye"></i> '.trans('backend.details').'</a>
              <button class="btn btn-delete btn btn-round  btn-danger" data-remote="/admin/unit/' . $data->id . '"><i class="fa fa-remove"></i>'.trans('backend.delete').'</button>
    
                ';
            })
            ->addColumn('state', function ($data) {
                if ($data->state_id==null)
                    return 'لم يتم اختيار منطقه بعد';
                else
                return unserialize($data->state->name)[LaravelLocalization::getCurrentLocale()];

            })
            ->addColumn('active', function ($data) {
                if ($data->activation_admin=='not_active')
                {
                    return '
              <button class="btn btn-active btn btn-round  btn-danger" data-remote="/admin/unit/activetion/' . $data->id . '">'.trans('backend.not_activation').'</button>
    
                ';
                }
                else{
                    return '
              <button class="btn btn-active btn btn-round  btn-success" data-remote="/admin/unit/activetion/' . $data->id . '">'.trans('backend.activation').'</button>
    
                ';
                }
            })
            ->addColumn('city', function ($data) {
                if ($data->city_id==null)
                    return 'لم يتم اختيار مدينه بعد';
                else
                return unserialize($data->city->name)[LaravelLocalization::getCurrentLocale()];

            })

            ->addColumn('type', function ($data) {
                return unserialize($data->unit_type->name)[LaravelLocalization::getCurrentLocale()];

            })
            ->addColumn('realtor', function ($data) {
                return'<a href="' . route('realtor.show', $data->user_id) . '">'.$data->realtor->name.'</a>';
            })
            ->addColumn('title', function ($data) {
                return'<a href="' . route('unit.show', $data->id) . '">'.$data->title.'</a>';
            })

            ->rawColumns(['action', 'state','city','type','realtor','title','active'])
            ->make(true);
    }


}
