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

use App\Http\Controllers\Auth\CustomController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test1', function () {
    return "welcome";
}) -> name('a');
Route::get('/test2/{id?}', function ($id) {
    return  "welcome Ahmed";
}) -> name('b');
Route::get('ahmed','FirstController@showstring');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('fillable','CrudController@getOffers');


    // Route::get('store','CrudController@store');
    // Route::get('create','CrudController@create');

Route::group([
        'prefix'=>LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]]
        ,function(){
                    Route::group(['prefix'=>'offers'], function(){
                        Route::get('create','CrudController@create');
                        Route::post('store','CrudController@store')->name('offers.store');
                        Route::get('all','CrudController@getAll');
                        Route::get('edit/{offer_id}','CrudController@editOffer');
                        Route::post('update/{offer_id}','CrudController@updateOffer')->name('offers.update');
                        Route::get('delete/{offer_id}','CrudController@deleteOffer')->name('offers.delete');;
                    });
                    Route::get('youtube','CrudController@getVideo')->middleware('auth');
});
    
################################# start Auth #################################
Route::group(['middleware'=>'CheckAge','namespace'=>'Auth'], function(){
    Route::get('adult','CustomController@adult')->name('adult');
});
Route::get('admin','Auth\CustomController@admin')->middleware('auth:Admin')->name('admin');
Route::get('site','Auth\CustomController@site')->middleware('auth')->name('site');
Route::get('admin/login','Auth\CustomController@adminLogin')->name('Admin.Login');
Route::post('admin/login','Auth\CustomController@checkAdminLogin')->name('save.admin.login');
################################## end Auth ##################################


    ######################## Strat relation Routes ############################
    Route::get('has-one','Relations\RelationController@hasOneRelation');
    Route::get('has-one-reverse','Relations\RelationController@hasOneRelationReverse');
    Route::get('has-one-where-has','Relations\RelationController@hasOneRelationWhereHas');
    Route::get('has-one-where-not-has','Relations\RelationController@hasOneRelationWhereNotHas');

    ##### one To many #####
    Route::get('hospital-has-many','Relations\RelationController@getHospitalDoctor');
    Route::get('hospital','Relations\RelationController@hospital');
    Route::get('doctor/{hospita_id}','Relations\RelationController@doctor')->name('hosptal.doctor');
    Route::get('delete/{hospita_id}','Relations\RelationController@delete')->name('delete.doctor');
    Route::get('delete/{hospita_id}','Relations\RelationController@deleteHospital')->name('hosptal.delete');
    Route::get('hospital-has-doctor','Relations\RelationController@hospitalHasDoctor');
    Route::get('hospital-not-has-doctor','Relations\RelationController@hospitalNotHasDoctor');
    Route::get('hospital-male','Relations\RelationController@hospitalMale');
    Route::get('doctor-service','Relations\RelationController@doctorServiec');
    Route::get('service/doctor','Relations\RelationController@serviecDoctor');
    
    ##### one To many #####
    Route::get('doctor/services/{doctor_id}','Relations\RelationController@getDoctorServices')->name('doctor.services');
    Route::post('saveServices','Relations\RelationController@saveServicesToDoctor')->name('save.services');
    ####### start has one through #####
    Route::get('has-one-through','Relations\RelationController@getHasOneThrough');
    Route::get('get_inactive','Relations\RelationController@getInactive');
    ######### end has one through #####
    ######################## End relation Routes ##############################
    ######################## Start Accessore Routes ##############################
    Route::get('accessore','Relations\RelationController@getAccessoreDoctor');

    ######################## End Accessore Routess ###############################

