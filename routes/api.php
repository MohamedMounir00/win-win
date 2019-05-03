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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/advanced_search', 'Frontend\SearchController@advanced_search')->name('advanced_search');
Route::post('/upload', 'Frontend\UploadController@Upload')->name('upload');
Route::post('/change_status', 'Frontend\AddUnitController@change_status');
Route::post('/state_by_id', 'Frontend\UserController@stateByid')->name('stateByid');
Route::post('/get_all_units', 'Frontend\AddUnitController@get_all_units')->name('get_all_units');
Route::post('/get_all_comment', 'Frontend\MainProfileController@get_all_comment')->name('get_all_comment');

