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

      Route::post('sendCode', 'AuthController@sendMobileCode');
      Route::post('checkCode', 'AuthController@checkCode');
      Route::post('updatePassword', 'AuthController@updatePassword');



      Route::get('cars/damaged', 'CarsController@damaged');
      Route::get('cars/antique', 'CarsController@antique');
      Route::get('car/{id}', 'CarsController@show');

      Route::get('brands', 'BrandsController@index');
      Route::get('brand/{id}', 'BrandsController@show');

      Route::get('cities/{id?}', 'CitiesController@index');
      Route::get('countries', 'CitiesController@countries');
      Route::get('regions/{id?}', 'CitiesController@regions');

      Route::get('pieces', 'StocksController@pieces');



      Route::get('stocks', 'StocksController@index');
      Route::get('stock/{id}', 'StocksController@show');
      Route::get('stocks/search', 'StocksController@search');

      Route::post('lang/change', 'LanguageController@change');

      Route::post('get_checkout', 'PaymentController@getCheckout');
      Route::post('getTransaction', 'PaymentController@getTransaction');
      Route::get('setting/{key}', 'SettingController@show');


      Route::group(['middleware'=>'auth:api'], function () {
          Route::post('profile', 'AuthController@edit_profile');
          Route::post('car', 'CarsController@store');
          Route::post('updateCar', 'CarsController@update');
          Route::delete('car/{id}', 'CarsController@destroy');
          Route::get('logout', 'AuthController@logout');

          Route::get('avaliable_models', 'AvliableModelController@index');
          Route::post('avaliable_model/{id?}', 'AvliableModelController@store');
          Route::get('avaliable_model/{id}', 'AvliableModelController@show');
          Route::delete('avaliable_model/delete', 'AvliableModelController@delete');


          Route::get('myRequests', 'RequestsController@myRequests');
          Route::get('requestDetails/{id}', 'RequestsController@requestDetails');
          Route::post('sendOffer', 'RequestsController@sendOffer');
      });
  });
