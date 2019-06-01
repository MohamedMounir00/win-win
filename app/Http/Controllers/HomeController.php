<?php

namespace App\Http\Controllers;

use App\Rating;
use App\ReportAdmin;
use App\Unit;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
      public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('NotActive');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.home');
    }

    public function search(Request $request) {
        $title = $request->title;
        return redirect()->to('search?title='.$title);
    }
    public function admin()
    {
        $units_active_count = Unit::where('activation_admin','active')->count();
        $units_Notactive_count = Unit::where('activation_admin','not_active')->count();
        $user_active_count = User::where('verification',true)->count();
        $user_Notactive_count = User::where('verification',false)->count();
        $units_max = Unit::get()->max('price');
        $units_min = Unit::get()->min('price');
        $lastUser = User::where('verification',false)->orderByDesc('created_at')->take(5)->get();
        $lastcomment= Rating::where('type','user')->orderByDesc('created_at')->take(5)->get();
        $lastreport= ReportAdmin::where('seen',false)->orderByDesc('created_at')->take(5)->get();


        return view('backend.home',compact('units_active_count',
            'units_active_count',
            'units_Notactive_count',
            'user_Notactive_count',
            'user_active_count',
            'units_max',
            'units_min',
            'lastUser',
            'lastcomment',
            'lastreport'

            ));
    }
}
