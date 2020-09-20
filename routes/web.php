<?php

use Illuminate\Support\Facades\Route;


Route::get('admin',[App\Http\Controllers\Admin\LoginController::class, 'index'])->name('admin');
Route::post('admin/login',[App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login');
Route::post('admin/logout',[App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],
    function(){


        Route::group(['prefix'=> 'admin','namespace' => 'Admin','middleware'=>'admin'], function () {

            Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
 

            Route::get('profile',[App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('admin.profile');            
            Route::post('profile/update',[App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');            

            /*************** Packages  **********************/
            Route::get('packages',[App\Http\Controllers\Admin\PackageController::class, 'index'])->name('admin.packages');            
            Route::post('package/{id?}',[App\Http\Controllers\Admin\PackageController::class, 'store'])->name('admin.package.store');
            Route::get('package/{item}',[App\Http\Controllers\Admin\PackageController::class, 'edit'])->name('admin.package');            
            Route::delete('package/delete',[App\Http\Controllers\Admin\PackageController::class, 'delete'])->name('admin.package.delete');            

            /******************* Users ********************/                
            Route::get('users',[App\Http\Controllers\Admin\UserController::class, 'all'])->name('admin.users');            
            Route::get('user/add',[App\Http\Controllers\Admin\UserController::class, 'add'])->name('admin.user.add');            
            Route::get('user/{item}',[App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.user');
            Route::post('user/store/{id?}',[App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.user.store');            
            Route::delete('user/delete',[App\Http\Controllers\Admin\UserController::class, 'delete'])->name('admin.user.delete');
                        
            /******************* Companies ********************/    
            Route::get('companies',[App\Http\Controllers\Admin\CompanyController::class, 'all'])->name('admin.companies');
            Route::get('company/add',[App\Http\Controllers\Admin\CompanyController::class, 'add'])->name('admin.company.add');
            Route::get('company/{item}',[App\Http\Controllers\Admin\CompanyController::class, 'show'])->name('admin.company');
            Route::post('company/store/{item?}',[App\Http\Controllers\Admin\CompanyController::class, 'store'])->name('admin.company.store');
            Route::delete('company/delete',[App\Http\Controllers\Admin\CompanyController::class, 'delete'])->name('admin.company.delete');

            /******************* Sellers ********************/    
            Route::get('sellers',[App\Http\Controllers\Admin\SellerController::class, 'all'])->name('admin.sellers');            
            Route::get('seller/add',[App\Http\Controllers\Admin\SellerController::class, 'add'])->name('admin.seller.add');
            Route::get('seller/{item}',[App\Http\Controllers\Admin\SellerController::class, 'show'])->name('admin.seller');
            Route::post('seller/store/{item?}',[App\Http\Controllers\Admin\SellerController::class, 'store'])->name('admin.seller.store');
            Route::delete('seller/delete',[App\Http\Controllers\Admin\SellerController::class, 'delete'])->name('admin.seller.delete');

            /******************* Brokers ********************/    
            Route::get('brokers',[App\Http\Controllers\Admin\BrokerController::class, 'all'])->name('admin.brokers');            
            Route::get('broker/add',[App\Http\Controllers\Admin\BrokerController::class, 'add'])->name('admin.broker.add');
            Route::get('broker/{item}',[App\Http\Controllers\Admin\BrokerController::class, 'show'])->name('admin.broker');
            Route::post('broker/store/{item?}',[App\Http\Controllers\Admin\BrokerController::class, 'store'])->name('admin.broker.store');
            Route::delete('broker/delete',[App\Http\Controllers\Admin\BrokerController::class, 'delete'])->name('admin.broker.delete');


            
            Route::get('reps',[App\Http\Controllers\Admin\RepController::class, 'all'])->name('admin.reps');            
            Route::get('supervisors',[App\Http\Controllers\Admin\SupervisorController::class, 'all'])->name('admin.supervisors');            
            Route::get('saudi',[App\Http\Controllers\Admin\SaudiController::class, 'all'])->name('admin.saudi');            
            Route::get('vip_requests',[App\Http\Controllers\Admin\VipRequestController::class, 'all'])->name('admin.vip_requests');            
            Route::get('rules',[App\Http\Controllers\Admin\RuleController::class, 'all'])->name('admin.rules');            
 

            // Route::resource('rules', 'RulesController')->except(['show','delete']);            
            Route::delete('/rule/delete','RulesController@delete')->name('admin.rule.delete'); 
            Route::get('rule/edit/{item}', 'RulesController@edit')->name('admin.rule.edit');    
            Route::post('rule/store/{item?}','RulesController@store')->name('admin.rule.store');


            /************ Social  **********/
            Route::get('social/all','SocialController@index')->name('admin.socials');                        
            Route::post('social/store/{item?}','SocialController@store')->name('admin.social.store');        
            Route::delete('social/delete','SocialController@delete')->name('admin.social.delete');
            Route::get('social/edit/{item}','SocialController@edit')->name('admin.social.edit');            

            /************ Settings  **********/

            Route::post('setting/store/{id?}','SettingsController@store')->name('admin.setting.store');        

            Route::get('settings/all','SettingsController@index')->name('admin.settings');                                    
            Route::delete('setting/delete','SettingsController@delete')->name('admin.setting.delete');
            Route::get('setting/edit/{item}','SettingsController@edit')->name('admin.setting.edit'); 
            
            
            /************ Requests  **********/
            Route::get('requests/normal', 'RequestsController@normal')->name('admin.requests.normal');
            Route::get('requests/vip', 'RequestsController@vip')->name('admin.requests.vip');
            Route::get('requests/express', 'RequestsController@express')->name('admin.requests.express');
            Route::get('requests/assign_to_admin', 'RequestsController@assign_to_admin')->name('admin.requests.assign_to_admin');
            Route::get('requests/deleted', 'RequestsController@deleted')->name('admin.requests.deleted');
            Route::get('request/{item}', 'RequestsController@show')->name('admin.request.show');
            Route::post('request/update/{item}','RequestsController@update')->name('admin.request.update');
            Route::post('request/delete/{item}','RequestsController@delete')->name('admin.request.delete');

            Route::get('request/engine/{item}', 'RequestsController@engine')->name('admin.request.engine');
            Route::get('engine_user/{user}/{item}','RequestsController@engine_user')->name('admin.request.engine_user');
            Route::post('engine_user/status/change/{item}','RequestsController@change_offer_status')->name('offerChange');


            /******************** Offers  **********/
            Route::get('offer/send/{item}','OffersController@send_offer')->name('admin.offer.send');

            

            /********* Search ********/
            Route::get('search','SearchController@index')->name('admin.search');


             /************ Export PDF Data  ***************************/
             Route::get('export/users/pdf','ExportPdfController@users')->name('export.pdf.users');
             Route::get('export/sellers/pdf','ExportPdfController@sellers')->name('export.pdf.sellers');
             Route::get('export/supervisors/pdf','ExportPdfController@supervisors')->name('export.pdf.supervisors');

             Route::get('export/requests/pdf/normal','ExportPdfController@requests_normal')->name('export.pdf.requests.normal');
             Route::get('export/requests/pdf/vip','ExportPdfController@requests_vip')->name('export.pdf.requests.vip');
             Route::get('export/requests/pdf/admin','ExportPdfController@requests_admin')->name('export.pdf.requests.admin');

             Route::get('export/cars/pdf/{type}','ExportPdfController@cars');
             Route::get('export/bidding/pdf','ExportPdfController@bidding');
             
             Route::get('export/stock/pdf','ExportPdfController@stock');
             Route::get('export/seller_brands/pdf/{item}','ExportPdfController@sellers_brands')->name('export.pdf.sellers_brands');

             /************ Export Excel Data  ***************************/
            Route::get('export/users/excel','ExportExcelController@users')->name('export.excel.users');
            Route::get('export/sellers/excel','ExportExcelController@sellers')->name('export.excel.sellers');
            Route::get('export/supervisors/excel','ExportExcelController@supervisors')->name('export.excel.supervisors');
            
            Route::get('export/excel/requests/normal','ExportExcelController@requests_normal')->name('export.excel.requests.normal');
            Route::get('export/excel/requests/vip','ExportExcelController@requests_vip')->name('export.excel.requests.vip');
            Route::get('export/excel/requests/admin','ExportExcelController@requests_admin')->name('export.excel.requests.admin');
            
            Route::get('export/cars/excel/{item}','ExportExcelController@cars');
            Route::get('export/bidding/excel','ExportExcelController@bidding');
            
            Route::get('export/stock/excel','ExportExcelController@stock');

            /************ Cars  ***************************/            
            Route::get('cars/damaged','CarsController@damaged')->name('admin.cars.damaged');
            Route::get('cars/antiques','CarsController@antiques')->name('admin.cars.antiques');
            Route::get('car/damaged/edit/{item}','CarsController@edit_damaged')->name('admin.car.damaged.edit');
            Route::get('car/antique/edit/{item}','CarsController@edit_antique')->name('admin.car.antique.edit');
            Route::get('car/{item}/comments','CarsController@comments')->name('admin.cars.comments');
            Route::post('car/comment/delete','CarsController@delete_comment')->name('admin.car.comment.delete');
            Route::post('car/comment/approve','CarsController@approve_comment')->name('admin.car.comment.approve');
            Route::post('car/damaged/store/{item}','CarsController@store_damaged')->name('admin.car.damaged.store');
            Route::post('car/antique/store/{item}','CarsController@store_antique')->name('admin.car.antique.store');
            Route::delete('car/delete','CarsController@delete')->name('admin.car.delete');
            Route::post('car/deleteImg','CarsController@deleteImg')->name('admin.carImg.delete');
            Route::post('car/images/store/{item}','CarsController@store_imgs')->name('admin.car.store_imgs');

            /************* Car Bidding *******************/
            Route::get('bidding/all','CarBiddingController@all')->name('admin.cars.bidding');
            Route::get('bidding/edit-approve/{id}/{status}','CarBiddingController@updateStatusApprove')->name('admin.bidding.updateStatusApprove');
            Route::get('bidding/edit-reject/{id}/{status}','CarBiddingController@updateStatusReject')->name('admin.bidding.updateStatusReject');
            Route::post('bidding/delete','CarBiddingController@delete')->name('admin.bidding.delete');
            Route::post('bidding/update/{id?}','CarBiddingController@update')->name('admin.bidding.store');

            /************* Brands *******************/
            Route::get('brands/all','BrandsController@all')->name('admin.brands');
            Route::get('brand/edit/{item}','BrandsController@edit')->name('admin.brand.edit');            
            Route::post('brand/store/{item?}','BrandsController@store')->name('admin.brand.store');
            Route::delete('brand/delete','BrandsController@delete')->name('admin.brand.delete');

            /************* Models *******************/
            Route::get('brand/models/{brand}','ModelsController@all')->name('admin.brand.models');
            Route::get('model/edit/{item}','ModelsController@edit')->name('admin.model.edit');            
            Route::post('model/store/{item?}','ModelsController@store')->name('admin.model.store');
            Route::delete('model/delete','ModelsController@delete')->name('admin.model.delete');

            /************* Pieces *******************/     
            Route::get('pieces/all','PiecesController@all')->name('admin.pieces');                        
            Route::get('piece/edit/{item}','PiecesController@edit')->name('admin.piece.edit');
            Route::post('piece/store/{item?}','PiecesController@store')->name('admin.piece.store');
            Route::delete('piece/delete','PiecesController@delete')->name('admin.piece.delete');
            Route::get('pieces/search','PiecesController@search')->name('admin.pieces.search');

            Route::post('piece/alt/store/{item?}','PiecesController@store_alts')->name('admin.piece.alts.store');
            Route::delete('piece/alt/delete','PiecesController@delete_alt')->name('admin.alt.delete');
            Route::post('piece/alt/update/{alt}','PiecesController@update_alt')->name('admin.piece.alt.update');

            /************* Bad Words *******************/
            Route::get('bad-word/all','BadWordsController@all')->name('admin.badwords');
            Route::get('bad-word/edit/{item}','BadWordsController@edit')->name('admin.badwords.edit');
            Route::post('bad-word/store/{id?}','BadWordsController@store')->name('admin.badwords.store');
            Route::delete('bad-word/delete','BadWordsController@delete')->name('admin.badwords.delete');

            /************* Contact Us *******************/
            Route::get('contact-us/all','ContactUsController@all')->name('admin.contact_us');
            Route::get('contact-us/show/{item}','ContactUsController@show')->name('admin.contact_us.show');
            Route::delete('contact-us/delete','ContactUsController@delete')->name('admin.contact_us.delete');

            /************* Ads *******************/
            Route::get('ads/all','AdsController@all')->name('admin.ads');
            Route::get('ad/edit/{item}','AdsController@edit')->name('admin.ad.edit');
            Route::post('ad/store/{item?}','AdsController@store')->name('admin.ad.store');
            Route::delete('ad/delete','AdsController@delete')->name('admin.ad.delete');

            /************* Pages *******************/
            Route::get('page/{item}','PagesController@edit')->name('admin.page');
            Route::post('page/store/{item}','PagesController@store')->name('admin.page.store');

            /************** Slider ***************************/
            Route::get('sliders/all','SliderController@all')->name('admin.sliders');
            Route::get('slider/add','SliderController@add')->name('admin.slider.add');
            Route::get('slider/edit/{item}','SliderController@edit')->name('admin.slider.edit');
            Route::post('slider/store/{item?}','SliderController@store')->name('admin.slider.store');
            Route::delete('slider/delete','SliderController@delete')->name('admin.slider.delete');


            /************* Ticker ****************************/
            Route::get('ticker/edit/{item}','TickerController@edit')->name('admin.ticker');
            Route::post('ticker/store/{item?}','TickerController@store')->name('admin.ticker.store');


            /************ Stock Management *****************/
            Route::get('stock','StocksController@all')->name('admin.stock');
            Route::get('stock/edit/{item}','StocksController@edit')->name('admin.stock.edit');
            Route::post('stock/store/{item?}','StocksController@store')->name('admin.stock.store');
            Route::get('stock/price/add/{item}','StocksController@add_price')->name('admin.stock.add_price');
            Route::post('stock/price/store/{item}','StocksController@store_price')->name('admin.stock.store_price');
            Route::delete('stock/delete','StocksController@delete')->name('admin.stock.delete');

            //---------- Engine ------------------            
            Route::get('engine','EngineController@index')->name('admin.engine');
            Route::get('engine/vip/delete','EngineController@vip_delete');
            Route::get('engine/normal/delete','EngineController@normal_delete');
            Route::get('engine/run','EngineController@run_engine')->name('engine.run');
            Route::get('engine/next_round','EngineController@next_round')->name('engine.next_round');

            /*************** Messages  **********************/
            Route::get('messages','MessagesController@all')->name('admin.messages');
            Route::get('message/edit/{item}','MessagesController@edit')->name('admin.message.edit');
            Route::post('message/store/{item?}','MessagesController@store')->name('admin.message.store');
            Route::post('message/delete','MessagesController@delete')->name('admin.message.delete');

            

        });

});
 


