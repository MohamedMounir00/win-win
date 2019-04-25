<?php

namespace App\Http\Controllers;

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
        return view('backend.home');
    }
}
