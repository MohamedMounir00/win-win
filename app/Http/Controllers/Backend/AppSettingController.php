<?php

namespace App\Http\Controllers\Backend;

use App\Appseting;
use App\AppSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;

class AppSettingController extends Controller
{
    //


    public function get_setting()
    {
        $settings= AppSetting::get();
        return view('backend.settings.index',compact('settings'));
    }

    public function post_settings(Request $request)
    {
        $settings= AppSetting::get();
        foreach ($settings as $setting)
        {
            $setting->update([
                'value'=> $request[$setting->key],
            ]);
        }
        if ($setting)
        Alert::success(trans('backend.updateFash'))->persistent("Close");

        return back();
    }

}
