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
Route::post('/change_status_fo', 'Frontend\AddUnitController@change_status')->name('change_status');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/upload', 'Frontend\UploadController@Upload')->name('upload');
Route::post('/upload_api', 'Frontend\UploadController@upload_api')->name('upload_api');
 /// first step  for register
Route::post('/first_step_register','Api\UserController@first_step_register');
/// section data for  user register user and add  unit
Route::get('/get_questions/{id}', 'Api\DataUserController@getInputByType');
Route::get('/get_data_for_unit', 'Api\DataUserController@get_data_for_unit');
Route::get('/get_cites', 'Api\DataUserController@get_cites');
Route::post('/state_by_id', 'Frontend\UserController@stateByid')->name('stateByid');
/// login
Route::post('/login','Api\UserController@login');

Route::middleware(['auth:api'])->group(function () {
    ///section profile
    Route::post('/second_step_register','Api\UserController@second_step_register');
    Route::get('/get_profile', 'Api\UserController@profile')->name('get_profile');
    Route::post('/updatet_profile', 'Api\UserController@updatet_profile')->name('updatet_profile');
    Route::post('/upload_image_profile', 'Api\UserController@upload_image_profile')->name('upload_image_profile');
    Route::get('/edit_profile_data', 'Api\UserController@edit_profile_data')->name('edit_profile_data');
    Route::post('/get_all_comment', 'Api\DataProfileController@get_all_comment')->name('get_all_comment');
    Route::post('/rating_user', 'Api\DataProfileController@addRating')->name('rating_user');
    Route::post('/add_report', 'Api\DataProfileController@add_report')->name('add_report');
    ////section units
    Route::post('/add_unit', 'Api\UnitsController@AddUnit')->name('add_unit');
    Route::get('/all_my_units', 'Api\UnitsController@all_my_units')->name('all_my_units');
    Route::get('/get_unit_details', 'Api\UnitsController@get_unit_details')->name('get_unit_details');
    Route::post('/change_status', 'Api\UnitsController@change_status');
    Route::get('/get_unit_edit', 'Api\UnitsController@get_unit_edit')->name('get_unit_edit');
    Route::post('/get_all_units', 'Api\UnitsController@get_all_units')->name('get_all_units');
    Route::post('/update_unit', 'Api\UnitsController@UpdateUnit')->name('update_unit');
    Route::post('/advanced_search', 'Api\UnitsController@advanced_search')->name('advanced_search');
    Route::get('/last_units', 'Api\UnitsController@last_units')->name('last_units');
    /// section chat
    Route::post('/send-message', 'Api\Chatcontroller@send_message')->name('send-message');
    Route::post('/get-messages', 'Api\Chatcontroller@get_message')->name('get-messages');
    Route::post('/get-conversation', 'Api\Chatcontroller@get_conversation')->name('get-conversation');
    Route::post('/get-unseen-conversation', 'Api\Chatcontroller@get_conversationunseen')->name('get-unseen-conversation');
    Route::get('/count-message', 'Api\Chatcontroller@count_message')->name('count-message');
    ////// section setting
    Route::get('/get-mediators', 'Api\HomePageController@mediators')->name('get-mediators');
    Route::post('/get_any_settings', 'Api\HomePageController@get_any_settings')->name('get_any_settings');



});
