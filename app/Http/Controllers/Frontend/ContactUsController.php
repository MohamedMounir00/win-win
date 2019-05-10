<?php

namespace App\Http\Controllers\Frontend;

use App\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Alert;

class ContactUsController extends Controller
{
    //

public  function contact_us(Request $request)
{

    $masage=$request->message;
    $email=$request->email;
    $name=$request->name;
    $phone=$request->phone;
    $admin=env("MAIL_USERNAME");
    ContactUs::create([
        'message'=>$masage,
        'email'=>$email,
        'name'=>$name,
        'phone'=>$phone,
    ]);
    Mail::send('email',
        array(
            'name' => $name,
            'email' => $email,
            'user_message' => $masage
        ), function($message )use($email,$admin)
        {
            $message->from($email);
            $message->to($admin, 'Admin')
                ->subject('win-win');


        });
    Alert::success(trans('frontend.send_message'))->persistent(trans('frontend.close'));

    return back();

}

}
