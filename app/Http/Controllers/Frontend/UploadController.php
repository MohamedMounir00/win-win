<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\Helper;
use App\Http\Requests\Frontend\UploadRequest;
use App\Image as imageModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    //

    //upload  image  for frontend
     public function upload(UploadRequest $request){
        $image=$this->image($request);
        $url=$image->url;
        return response()->json(['status'=>true,'id'=>$image->id,'url'=>$url]);
    }
    //upload image for webservices
     public function upload_api(UploadRequest $request){
        $image=$this->image($request);
        $url=$image->url;
        return response()->json(['status'=>true,'id'=>$image->id,'url'=>$url]);
    }
    // function upload for all
     public  function image($request)
     {
         $image = $request->file('image');
         $slug= "bgh-dsd";
         $key=time() . rand(99999, 999999999);
         $fileName = "img-".$slug."-".$key. "." . strtolower($image->getClientOriginalExtension());
         $destinationPath = 'uploads/units/';

         //Upload Images One After the Order into folder
         $img = Image::make($image->getRealPath());
         $watermark = Image::make(public_path('/frontend/images/watermark-logo.png'));
         //  $watermark = Image::make(public_path('/frontend/images/logo.png'));
         // resize watermark width keep height auto
         $resizePercentage = 25;//70% less then an actual image (play with this value)
         $watermarkSize = $img->height() / 3; //half of the image size
         $watermark->resize(null, $watermarkSize, function ($constraint) {
             $constraint->aspectRatio();
         });
         $img->insert($watermark, 'bottom-right');
         $img->save(public_path($destinationPath).'/'.$fileName);
         //$move = $image->move($destinationPath, $fileName);
         $path=$destinationPath.$fileName;
         $image=imageModel::create([
             'url'=>$path
         ]);
         return $image;
     }

}
