<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Helper\Helper;
use App\Http\Requests\Api\FirstRegisterStep;
use App\Http\Requests\Api\SecondRegisterStep;
use App\Http\Requests\Frontend\UpdateProfileRequest;
use App\Http\Resources\Api\LoginCollection;
use App\Http\Resources\Api\ProfileCollection;
use App\Http\Resources\Api\StatusCollection;
use App\Http\Resources\Api\UserCollection;
use App\Http\Resources\Frontend\StataCollection;
use App\Rating;
use App\Realtor;
use App\State;
use App\Unit;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
    //
    //first step register
    public function first_step_register(FirstRegisterStep $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'register' => 'first_step',
            'verification' => 0,
            'image' => Helper::UploadImge($request, 'uploads/avatars/', 'image'),
            'city_id' => $request->city_id,
            'state_id' => $request->state_id,
        ]);
        Realtor::create([
            'company_name' => $request->company_name,
            'user_id' => $user->id

        ]);
        $client = \Laravel\Passport\Client::where('password_client', 1)->first();

        $request->request->add([
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $user['email'],
            'password' => $user['password'],
            'scope' => null,
        ]);

        // Fire off the internal request.
        $proxy = Request::create(
            'oauth/token',
            'POST'
        );

        //return \Route::dispatch($proxy);
        $user['token'] = $user->createToken('MyApp')->accessToken;
        return new LoginCollection($user);
    }
    //second step register
    public function second_step_register(SecondRegisterStep $request)
    {

        $lang = $request->lang;


        if (auth()->user()->register == 'second_step')
            return (new StatusCollection(false, trans('api.first_registrt', [], $lang)))->response()
                ->setStatusCode(400);

        $user = User::findOrFail(auth()->user()->id);

        $user->update([
            'phone' => $request->phone,
            'register' => 'second_step'
        ]);
        $user->realtor->update([
            'bio' => $request->bio,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'phone3' => $request->phone3,
            'address' => $request->address,
        ]);
        return (new StatusCollection(true, trans('api.register_done', [], $lang),'second_step'))->response()
            ->setStatusCode(201);


    }
    //// login
    public function login(Request $request)
    {
        $lang = $request->lang;

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return (new StatusCollection(false, trans('api.login_false', [], $lang)))->response()
                ->setStatusCode(401);
        }


        if (Hash::check($request->password, $user->password)) {
            $client = \Laravel\Passport\Client::where('password_client', 1)->first();

            $request->request->add([
                'grant_type' => 'password',
                'client_id' => $client->id,
                'client_secret' => $client->secret,
                'username' => $user['email'],
                'password' => $user['password'],
                'scope' => null,
            ]);

            // Fire off the internal request.
            $proxy = Request::create(
                'oauth/token',
                'POST'
            );

            $user['token'] = $user->createToken('MyApp')->accessToken;

            return new LoginCollection($user);
        } else
            return (new StatusCollection(false, trans('api.login_false', [], $lang)))->response()
                ->setStatusCode(401);
    }
    ////any  profile by id
    public function profile(Request $request)
    {
        $id = $request->user_id;
        $lang = $request->lang;
        $user = User::findOrFail($id);
        if ($user->realtor)
            return new UserCollection($user);
        else
            return (new StatusCollection(false, trans('api.not_permission', [], $lang)))->response()
                ->setStatusCode(400);
    }
    // get my profile by auth
    public function edit_profile_data(Request $request)
    {
        $lang = $request->lang;

        if (auth()->user()->realtor) {

            $id = auth()->user()->id;
            $user = User::findOrFail($id);
            return new ProfileCollection($user);
        } else
            return (new StatusCollection(false, trans('api.not_permission', [], $lang)))->response()
                ->setStatusCode(400);
    }
    ///////////update profile by auth
    public function updatet_profile(UpdateProfileRequest $request)
    {
        $lang = $request->lang;

        $id = auth()->user()->id;
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->image = Helper::UpdateImage($request, 'uploads/avatars/', 'image', $user->image);
        $user->state_id = $request->state_id;
        $user->city_id = $request->city_id;

        if (isset($request->password))
            $user->password = bcrypt($request->password);
        $user->save();
        $user->realtor->update([
            'bio' => $request->bio,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'phone3' => $request->phone3,
            'address' => $request->address,
            'company_name' => $request->company_name,
        ]);
        return (new StatusCollection(true, trans('api.update_done', [], $lang)))->response()
            ->setStatusCode(201);

    }
    /// upload image profile
    public  function  upload_image_profile(Request $request)
 {
     $lang = $request->lang;

     $id = auth()->user()->id;
     $user = User::findOrFail($id);
     $user->image = Helper::UpdateImage($request, 'uploads/avatars/', 'image', $user->image);
     $user->save();
     $url= url($user->image);
     return (new StatusCollection(true, trans('api.update_done', [], $lang),$url))->response()
         ->setStatusCode(201);
 }

}
