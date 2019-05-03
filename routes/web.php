<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::get('/', function () {
        redirect('/ar');

        return view('welcome');
    })->middleware('active');

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
});
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['auth','localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
////////////////////////////////////////////////////////////  frontend  //////////////////////////////////////////////////////////////
////////////////////////////////////insaid main

    Route::post('/search-form', 'HomeController@search')->name('search-form');
    Route::get('/search', 'Frontend\SearchController@search_view')->name('search');
    Route::get('/details/{id}', 'Frontend\SearchController@unit_details')->name('details');
    Route::get('/get_data_view', 'Frontend\MainUnitController@get_data_view')->name('get_data_view');
    Route::post('add-unit-main', 'Frontend\MainUnitController@AddUnit')->name('add-main-main');
       /////////////////////////////////////////// rating
    Route::post('/rating_user', 'Frontend\MainProfileController@addRating')->name('rating_user');

    Route::get('/get_profile_view/{id}', 'Frontend\MainProfileController@profile')->name('get_profile_view');
    Route::post('/add_report', 'Frontend\MainProfileController@add_report')->name('add_report');
    Route::get('/get_all_comment_view/{id}', 'Frontend\MainProfileController@get_all_comment_view')->name('get_all_comment_view');
/////////////////////////////for outside main
    Route::get('/add-unit-page', 'Frontend\AddUnitController@get_unit_view')->name('add-unit-page');
    Route::post('add-unit', 'Frontend\AddUnitController@AddUnit')->name('add-unit');

    Route::get('/all-my-unit-page', 'Frontend\AddUnitController@all_my_units_view')->name('all-my-unit-page');
    Route::get('/all-my-unit', 'Frontend\AddUnitController@all_my_units')->name('all-my-unit');
    Route::get('/thank-you-page', 'Frontend\UserController@thank_view')->name('thank-you-page');

    Route::get('/complete-information-page', 'Frontend\UserController@seciend_step_view')->name('complete-information-page');
    Route::PUT('/complete-information', 'Frontend\UserController@seciend_step')->name('complete-information');


////////////////////////////////////////////////////////////  Backend  //////////////////////////////////////////////////////////////
    Route::group(['middleware' => ['admin' ]], function () {
        Route::get('/admin', 'HomeController@admin')->name('admin');
        /////////////////////type units
        Route::get('type_unit/get_type_unit','Backend\TypeUnitController@getAnyDate')->name('type_unit.get_type_unit');
        Route::resource('type_unit','Backend\TypeUnitController');
        //////////////////////////cities
        Route::get('cities/get_cities','Backend\CityController@getAnyDate')->name('cities.get_cities');
        Route::resource('cities','Backend\CityController');
        /////////////////////////////state
        Route::get('state/get_state','Backend\StatsController@getAnyDate')->name('state.get_state');
        Route::resource('state','Backend\StatsController');
        //////////////////////////////// realtor////////////
        Route::get('realtor/get_realtor','Backend\RealtorController@getAnyDate')->name('realtor.get_realtor');
        Route::resource('realtor','Backend\RealtorController');
        /////////////////////////////////////////////////////////////admins
        Route::get('admins/get_admins','Backend\AdminsController@getAnyDate')->name('admins.get_admins');
        Route::resource('admins','Backend\AdminsController');
        /////////////////////////////// unit
        Route::get('unit/get_unit','Backend\UnitsController@getAnyDate')->name('unit.get_unit');
        Route::resource('unit','Backend\UnitsController');
        ////////////////////////////////////////////// unit_not_active
        Route::get('unit_not_active','Backend\UnitsController@unit_not_active')->name('unit_not_active');
        Route::get('get_not_active','Backend\UnitsController@getNotActive')->name('get_not_active');
        Route::get('unit/active/{id}','Backend\UnitsController@active')->name('unit.active');
        Route::get('get_unit_user_view/{id}/{status}','Backend\UnitsController@get_unit_user_view')->name('get_unit_user_view');
        Route::get('get_unit_user/{id}/{status}','Backend\UnitsController@get_unit_user')->name('get_unit_user');
        /////////////////////////////////////////////////////////setting
        Route::get('get_settings','Backend\AppSettingController@get_setting')->name('get_settings');
        Route::post('post_settings','Backend\AppSettingController@post_settings')->name('post_settings');

        Route::post('/rating', 'Backend\RealtorController@addRating')->name('rating');
              ////////////////////////////////////////////////////report

        Route::get('report/get_report','Backend\ReportControler@getAnyDate')->name('report.get_report');
        Route::resource('report','Backend\ReportControler');

    });


});
//Route::post('api/advanced_search', 'Frontend\SearchController@advanced_search')->name('advanced_search')->middleware('auth');
Route::get('/get_questions/{id}', 'Frontend\AddUnitController@getInputByType');

