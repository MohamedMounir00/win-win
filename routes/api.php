<?php

use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/change_status', 'Frontend\AddUnitController@change_status')->name('change_status');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/state_by_id', 'Frontend\UserController@stateByid')->name('stateByid');
Route::post('/upload', 'Frontend\UploadController@Upload')->name('upload');
Route::post('/first_step_register','Api\UserController@first_step_register');
Route::post('/login','Api\UserController@login');
Route::get('/get_questions/{id}', 'Api\DataUserController@getInputByType');
Route::get('/get_data_for_unit', 'Api\DataUserController@get_data_for_unit');
Route::get('/get_cites', 'Api\DataUserController@get_cites');

Route::middleware(['auth:api'])->group(function () {
    Route::post('/second_step_register','Api\UserController@second_step_register');
    Route::get('/get_profile', 'Api\UserController@profile')->name('get_profile');
    Route::post('/updatet_profile', 'Api\UserController@updatet_profile')->name('updatet_profile');
    Route::get('/edit_profile_data', 'Api\UserController@edit_profile_data')->name('edit_profile_data');
    Route::post('/add_unit', 'Api\UnitsController@AddUnit')->name('add_unit');

Route::post('/advanced_search', 'Frontend\SearchController@advanced_search')->name('advanced_search');
Route::post('/get_all_units', 'Frontend\AddUnitController@get_all_units')->name('get_all_units');
Route::post('/get_all_comment', 'Frontend\MainProfileController@get_all_comment')->name('get_all_comment');
Route::post('/send-message', 'Frontend\Chatcontroller@send_message')->name('send-message');
Route::post('/get-messages', 'Frontend\Chatcontroller@get_message')->name('get-messages');
Route::post('/get-conversation', 'Frontend\Chatcontroller@get_conversation')->name('get-conversation');

});
