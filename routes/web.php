<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurveyListController;
use App\Http\Controllers\SurveyStubNumberController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\ShopController;

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
Auth::routes(['verify'=> true]);


Route::get('/', [SurveyController::class, 'index']);
Route::get('/survey', [SurveyController::class, 'index']);
Route::post('survey/store', [SurveyController::class, 'store']);
Route::get('survey/check/{code}', [SurveyController::class, 'check']);
Route::get('survey/voucher/{code}/{id}', [SurveyController::class, 'voucher']);
Route::get('practice', [SampleController::class, 'index']);


Route::group(['middleware'=> 'auth'], function() {

    
    Route::get('admin', [HomeController::class, 'index']);
    Route::get('admin/logout', '\App\Http\Controllers\Auth\LoginController@logout');

    /* dashboard */
    Route::get('home', [HomeController::class, 'index']);
    Route::get('dashboard', [HomeController::class, 'index']);
    Route::get('dashboard/getdata', [HomeController::class, 'getdata']);
    Route::get('dashboard/filter/{city}/{transact_type}', [HomeController::class, 'filter']);
    Route::get('dashboard/improvement', [HomeController::class, 'improvments']);
    Route::get('dashboard/transact_survey', [HomeController::class, 'transact_survey']);


    /* city */
    Route::get('city', [CityController::class, 'index']);
    Route::get('city/getdata', [CityController::class, 'getdata']);
    Route::post('city/store', [CityController::class, 'store']);
    Route::get('city/edit/{id}', [CityController::class, 'edit']);
    Route::patch('city/update', [CityController::class, 'update']);
    Route::get('city/destroy/{id}', [CityController::class, 'destroy']);


    /* survey stub */
    Route::get('survey_number', [SurveyStubNumberController::class, 'index']);
    Route::get('survey_number/getdata', [SurveyStubNumberController::class, 'getdata']);
    Route::post('survey_number/store', [SurveyStubNumberController::class, 'store']);
    Route::get('survey_number/destroy/{id}', [SurveyStubNumberController::class, 'destroy']);
    Route::get('survey_number/filter/{city}/{shop}', [SurveyStubNumberController::class, 'filter']);
    Route::get('survey_number/getshopdata/{city}', [SurveyStubNumberController::class, 'getshopdata']);
    Route::get('survey_number/pdf/{city}/{shop}', [SurveyStubNumberController::class, 'pdf']);


    /* survey */
    Route::get('survey_list', [SurveyListController::class, 'index']);
    Route::get('survey_list/getdata', [SurveyListController::class, 'getdata']);


    /* voucher code */
    Route::get('voucher', [VoucherController::class, 'index']);
    Route::get('voucher/getdata', [VoucherController::class, 'getdata']);


    /* user account */
    Route::get('users',[UserController::class, 'index']);
    Route::get('users/getrecords', [UserController::class, 'getRecords']);
    Route::get('users/edit/{id}', [UserController::class, 'getUserToEdit']);
    Route::patch('users/update/{id}', [UserController::class, 'update']);
    Route::get('users/destroy/{id}', [UserController::class, 'destroy']);
    Route::post('users/store', [UserController::class, 'store']);


    /* shops */
    Route::get('shops', [ShopController::class, 'index']);
    Route::get('shops/getdata', [ShopController::class, 'getdata']);
    Route::post('shops/store', [ShopController::class, 'store']); 
    Route::get('shops/edit/{id}', [ShopController::class, 'edit']);
    Route::patch('shops/update', [ShopController::class, 'update']);
    Route::get('shops/destroy/{id}', [ShopController::class, 'destroy']);


});
