<?php
/**
 * Created by PhpStorm.
 * User: Shrkaty_10
 * Date: 20/11/2018
 * Time: 11:53 ص
 */

namespace App\Helper;

use App\Unit;
use App\User;
use Illuminate\Support\Facades\File;
use DB;
use Illuminate\Support\Facades\Mail;

class Helper
{


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
 public  static  function count_unit_not_active()
 {
     return Unit::where('activation_admin','not_active')->count();
 }



}

