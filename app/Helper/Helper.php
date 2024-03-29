<?php
/**
 * Created by PhpStorm.
 * User: Shrkaty_10
 * Date: 20/11/2018
 * Time: 11:53 ص
 */

namespace App\Helper;

use App\AppSetting;
use App\Chat;
use App\ContactUs;
use App\Conversation;
use App\ReportAdmin;
use App\Unit;
use App\User;
use Illuminate\Support\Facades\File;
use DB;
use Illuminate\Support\Facades\Mail;

class Helper
{
     /// for upload image
    public static function UploadImge($request,$path,$input)
    {
        if ($request->hasFile($input)) {

            $img_name = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path($path), $img_name);
            $db_name = $path . $img_name;
            return $db_name;
        }
        else
            $db_name ='';
        return $db_name;

    }
    /// for update upload image
    public static function UpdateImage($request,$path,$input,$model)
{
    if ($request->hasFile($input)) {
        if ($model != '') {

            if (File::exists(public_path($model))) { // unlink or remove previous image from folder
                unlink(public_path($model));
            }
            $img_name = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path($path), $img_name);
            $db_name =  $path . $img_name;
            return $db_name;


        } else {
            $img_name = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path($path), $img_name);
            $db_name = $path . $img_name;
            return $db_name;

        }
    } else
        $db_name = $model;
    return $db_name;

}
    // get count unit not active for backend
    public  static  function count_unit_not_active()
 {
     return Unit::where('activation_admin','not_active')->count();
 }

    /// get any setting
    public  static  function get_setting($data)
    {
        return AppSetting::where('key',$data)->first();
    }
    // count un seen message  backend
    public  static  function count_message()
    {
        return ContactUs::where('seen',false)->count();
    }
    // count report un seen for backend
    public  static  function count_report()
    {
        return ReportAdmin::where('seen',false)->count();
    }
    /// count unseen message me in Conversation for frontend and webservices
    public static function count_unseen_message()
   {
       $count = Conversation::whereHas('messages', function($q){
           $q->where('receiver_id',auth()->user()->id)->where('seen',false);
       })->count();
     return $count;

   }
//////////////////// floor
    public static function floor()
    {
        $floor=[trans('frontend.ground'),trans('frontend.bizment'),trans('frontend.roof'),
            1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30];
        return $floor;

    }
    public static  function  mail($email,$view)
    {
        Mail::to($email)->send($view);

    }
}

