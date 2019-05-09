<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\Helper;
use App\Image as imageModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    //


    public function upload(Request $request){
        $image = $request->file('image');
        $slug= "bgh-dsd";
        $key=time() . rand(99999, 999999999);
        $fileName = "img-".$slug."-".$key. "." . strtolower($image->getClientOriginalExtension());
        $destinationPath = 'uploads/units/';



        //Upload Images One After the Order into folder
        $img = Image::make($image->getRealPath());
        $watermark = Image::make(public_path('/frontend/images/logo.png'));
        $img->insert($watermark, 'bottom-right');
        $img->save(public_path($destinationPath).'/'.$fileName);
        //$move = $image->move($destinationPath, $fileName);
        $path=$destinationPath.'/'.$fileName;
        $image=imageModel::create([
            'url'=>$path
        ]);
        return response()->json(['status'=>true,'id'=>$image->id,'url'=>$image->url]);
    }

}
