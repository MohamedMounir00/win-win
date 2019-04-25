<?php

namespace App\Http\Controllers\Backend;

use App\City;
use App\Helper\Helper;
use App\Rating;
use App\State;
use App\Unit;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Yajra\Datatables\Datatables;
use Alert;
class RealtorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.realtor.index');
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

        $rating= Rating::where('realtor_id',$id)->where('type','admin')->get();
        $rating_time=floatval($rating->avg('rating_stars'));
        $rating2= Rating::where('realtor_id',$id)->where('type','user')->get();
        $rating_time_user=floatval($rating2->avg('rating_stars'));
        $user= User::with('realtor')->findOrFail($id);
        $unit_active_count= Unit::where('user_id',$id)->where('activation_admin','active')->count();
        $unit_not_active_count=Unit::where('user_id',$id)->where('activation_admin','not_active')->count();
        return view('backend.realtor.show', compact('user','rating_time','rating_time_user','unit_active_count','unit_not_active_count'));

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


        $data=User::findOrFail($id);
        $request->validate([
            //   'decs'=>'required',

            'name'=>'required',
            'email' => 'required|email|unique:users,email,'. $data->id,
            'password' => 'nullable|min:6',
            'phone'=>'required|min:9',
            'state_id'=>'required',
            'city_id'=>'required',
            'company_name'=>'required',

        ]);


        // $data->update([
        $data->name     = $request->name;
        $data->email      = $request->email;
        $data->phone       = $request->phone;
        $data->image       = Helper::UpdateImage($request,'uploads/avatars/','image',$data->image);
        $data->state_id  = $request->state_id;
        $data->city_id  = $request->city_id;
        $data->verification       = $request->verification;

        if (isset($request->password))
            $data->password = bcrypt($request->password);      //  ]);
        $data->save();
        $data->realtor->update([
            'company_name'   => $request->company_name,

        ]);

        if ($data)
            Alert::success(trans('backend.updateFash'))->persistent("Close");
        return redirect()->route('realtor.index');
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
        $data->realtor;
        $data->delete();
        Alert::success(trans('backend.deleteFlash'))->persistent("Close");

        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }




    public function getAnyDate()
    {
        $data = User::whereHas('realtor', function ($q) {
        })->get();

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '<a href="' . route('realtor.edit', $data->id) . '" class="btn btn-round  btn-primary"><i class="fa fa-edit"></i> '.trans('backend.update').'</a>
                    <a href="' . route('realtor.show', $data->id) . '" class="btn btn-round  btn-primary"><i class="fa fa-eye"></i> '.trans('backend.details').'</a>
              <button class="btn btn-delete btn btn-round  btn-danger" data-remote="state/' . $data->id . '"><i class="fa fa-remove"></i>'.trans('backend.delete').'</button>
    
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
            ->addColumn('company_name', function ($data) {
                return $data->realtor->company_name;

            })
            ->addColumn('verification', function ($data) {
                if ($data->verification==1)
                  return trans('backend.active_client');
                else
                return trans('backend.disactive');
            })

            ->rawColumns(['action', 'state','city','image','company_name','verification'])
            ->make(true);
    }

    public function addRating(Request $request)
    {
        $rating = new Rating;
        $rating->user_id = auth()->user()->id;
        $rating->realtor_id = $request->realtor_id;
        $rating->rating_stars = $request->star;
        $rating->save();
        return response()->json(['rating' => $rating->rating_stars]);
    }
}
