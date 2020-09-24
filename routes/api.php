<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post("login", "AuthController@login");
Route::post("register", "AuthController@register");

Route::group(["middleware" => "auth.jwt"], function () {
    Route::get("logout", "AuthController@logout");


});

Route::apiResource('customers','Api\CustomerController');
Route::post('customers/create',"Api\CustomerController@store");
Route::put('customers/update/{id}','Api\CustomerController@update');
Route::delete('/customers/{id}/delete' , 'Api\CustomerController@destroy');

Route::apiResource('comproflie','Api\ComproflieController');
Route::post('comproflie/create',"Api\ComproflieController@store");
Route::put('comproflie/update/{id}','Api\ComproflieController@update');
Route::delete('/comproflie/{id}/delete' , 'Api\ComproflieController@destroy');

Route::apiResource('inks','Api\InkController');
Route::post('inks/create',"Api\InkController@store");
Route::put('inks/update/{id}','Api\InkController@update');
Route::delete('/inks/{id}/delete' , 'Api\InkController@destroy');

Route::apiResource('sellers','Api\SellerController');
Route::post('sellers/create',"Api\SellerController@store");
Route::put('sellers/update/{id}','Api\SellerController@update');
Route::delete('/sellers/{id}/delete' , 'Api\SellerController@destroy');

Route::apiResource('bills','Api\BillController');
Route::post('bills/create',"Api\BillController@store");
Route::put('bills/update/{id}','Api\BillController@update');
Route::delete('/bills/{id}/delete' , 'Api\BillController@destroy');





