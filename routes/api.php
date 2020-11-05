<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/


  Route::group(['namespace' => 'Api','prefix' => 'v1'], function () {
      Route::post('lang/change', 'LanguageController@change');
      Route::post('login', 'AuthController@login');
      Route::post('register', 'AuthController@register');
      Route::get('profile', 'AuthController@profile');

      Route::get('cars/damaged', 'CarsController@damaged');
      Route::get('cars/antique', 'CarsController@antique');
      Route::get('car/{id}', 'CarsController@show');


      Route::group(['middleware'=>'auth:api'], function () {
          Route::post('profile', 'AuthController@edit_profile');
          Route::post('car', 'CarsController@store');
          Route::put('car', 'CarsController@store');
          Route::delete('car/{id}', 'CarsController@destroy');
      });
  });
