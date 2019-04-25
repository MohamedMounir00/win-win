<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\Helper;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    //


    public function upload(Request $request){
        $request->validate([
            'image'=>'image'
        ]);
        $image=Image::create([
            'url'=>Helper::UpdateImage($request,'uploads/units/','image',$request->image)
        ]);
        return response()->json(['status'=>true,'id'=>$image->id,'url'=>$image->url]);
    }

}
