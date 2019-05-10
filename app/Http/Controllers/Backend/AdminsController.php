<?php

namespace App\Http\Controllers\Backend;

use App\Admin;
use App\City;
use App\Helper\Helper;
use App\Http\Requests\Backend\AdminsRequest;
use App\State;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Yajra\Datatables\Datatables;
use Alert;
use Spatie\Permission\Models\Role;
use DB;
class AdminsController extends Controller
{
    //


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.admins.index');
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
        $state=State::all();
        $roles = Role::pluck('name','name')->all();

        return view('backend.admins.create', compact('city','state','roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminsRequest $request)
    {


        $admin= User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'city_id'=>$request->city_id,
            'state_id'=>$request->state_id,
            'phone'=>$request->phone,
            'image'       => Helper::UploadImge($request,'uploads/avatars/','image'),


        ]);
        Admin::create([
            'user_id'=>$admin->id
        ]);
        $admin->assignRole($request->input('roles'));

        if ($admin)
            Alert::success(trans('backend.created'))->persistent("Close");

        return redirect()->route('admins.index');

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


      //  $user= User::with('admins')->findOrFail($id);

       // return view('backend.admins.show', compact('user'));

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
        $state=State::all();

        $data = User::findOrFail($id);
        $roles = Role::pluck('name','name')->all();
       // $userRole = $data->roles->pluck('name','name')->all();
        return view('backend.admins.edit', compact('data','city','state','userRole','roles'));

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


        $data=User::findOrFail($id);
        $request->validate([
            //   'decs'=>'required',

            'name'=>'required',
            'email' => 'required|email|unique:users,email,'. $data->id,
            'password' => 'nullable|min:6',
            'phone'=>'required|min:9',
            'state_id'=>'required',
            'city_id'=>'required',
          //  'roles' => 'required'


        ]);


        // $data->update([
        $data->name     = $request->name;
        $data->email      = $request->email;
        $data->phone       = $request->phone;
        $data->image       = Helper::UpdateImage($request,'uploads/avatars/','image',$data->image);
        $data->state_id  = $request->state_id;
        $data->city_id  = $request->city_id;
        if (isset($request->password))
            $data->password = bcrypt($request->password);      //  ]);
        $data->save();

       // if (!$data->hasRole('admin')) {
         ///   DB::table('model_has_roles')->where('model_id',$id)->delete();
           // $data->assignRole($request->input('roles'));
       // }
        if ($data)
            Alert::success(trans('backend.updateFash'))->persistent("Close");
        return redirect()->route('admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->admins;
        $data->delete();
        Alert::success(trans('backend.deleteFlash'))->persistent("Close");

        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }




    public function getAnyDate()
    {
        $data = User::whereHas('admins', function ($q) {
        })->get();
           //<a href="' . route('admins.show', $data->id) . '" class="btn btn-round  btn-primary"><i class="fa fa-eye"></i> '.trans('backend.details').'</a>
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '<a href="' . route('admins.edit', $data->id) . '" class="btn btn-round  btn-primary"><i class="fa fa-edit"></i> '.trans('backend.update').'</a>
                    
              <button class="btn btn-delete btn btn-round  btn-danger" data-remote="admins/' . $data->id . '"><i class="fa fa-remove"></i>'.trans('backend.delete').'</button>
    
                ';
            })
            ->addColumn('state', function ($data) {
                return unserialize($data->state->name)[LaravelLocalization::getCurrentLocale()];

            })
            ->addColumn('city', function ($data) {
                return unserialize($data->city->name)[LaravelLocalization::getCurrentLocale()];

            })
            ->addColumn('image', function ($data) { $url=asset($data->image);
                if ($data->image=='')
                    return '<img src="https://www.mycustomer.com/sites/all/modules/custom/sm_pp_user_profile/img/default-user.png" border="0" width="40" class="img-rounded" align="center" />';

                else
                    return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />';

            })


            ->rawColumns(['action', 'state','city','image'])
            ->make(true);
    }

}
