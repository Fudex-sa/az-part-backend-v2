<?php

use Illuminate\Support\Facades\Route;



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],
    function(){

        /*************** Admin Auth  **********************/
        Route::get('admin',[App\Http\Controllers\Admin\LoginController::class, 'index'])->name('admin');
        Route::post('admin/login',[App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login');
        Route::post('admin/logout',[App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');

        
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
            Route::post('user/activate',[App\Http\Controllers\Admin\UserController::class, 'activate'])->name('admin.user.activate');

            /******************* Companies ********************/    
            Route::get('companies',[App\Http\Controllers\Admin\CompanyController::class, 'all'])->name('admin.companies');
            Route::get('company/add',[App\Http\Controllers\Admin\CompanyController::class, 'add'])->name('admin.company.add');
            Route::get('company/{item}',[App\Http\Controllers\Admin\CompanyController::class, 'show'])->name('admin.company');
            Route::post('company/store/{item?}',[App\Http\Controllers\Admin\CompanyController::class, 'store'])->name('admin.company.store');
            Route::delete('company/delete',[App\Http\Controllers\Admin\CompanyController::class, 'delete'])->name('admin.company.delete');
            Route::post('company/activate',[App\Http\Controllers\Admin\CompanyController::class, 'activate'])->name('admin.company.activate');

            /******************* Sellers ********************/    
            Route::get('sellers',[App\Http\Controllers\Admin\SellerController::class, 'all'])->name('admin.sellers');            
            Route::get('seller/add',[App\Http\Controllers\Admin\SellerController::class, 'add'])->name('admin.seller.add');
            Route::get('seller/{item}',[App\Http\Controllers\Admin\SellerController::class, 'show'])->name('admin.seller');
            Route::post('seller/store/{item?}',[App\Http\Controllers\Admin\SellerController::class, 'store'])->name('admin.seller.store');
            Route::delete('seller/delete',[App\Http\Controllers\Admin\SellerController::class, 'delete'])->name('admin.seller.delete');
            Route::post('seller/activate',[App\Http\Controllers\Admin\SellerController::class, 'activate'])->name('admin.seller.activate');

            /******************* Brokers ********************/    
            Route::get('brokers',[App\Http\Controllers\Admin\BrokerController::class, 'all'])->name('admin.brokers');            
            Route::get('broker/add',[App\Http\Controllers\Admin\BrokerController::class, 'add'])->name('admin.broker.add');
            Route::get('broker/{item}',[App\Http\Controllers\Admin\BrokerController::class, 'show'])->name('admin.broker');
            Route::post('broker/store/{item?}',[App\Http\Controllers\Admin\BrokerController::class, 'store'])->name('admin.broker.store');
            Route::delete('broker/delete',[App\Http\Controllers\Admin\BrokerController::class, 'delete'])->name('admin.broker.delete');
            Route::post('broker/activate',[App\Http\Controllers\Admin\BrokerController::class, 'activate'])->name('admin.broker.activate');

            /******************* Reps ********************/                
            Route::get('reps',[App\Http\Controllers\Admin\RepController::class, 'all'])->name('admin.reps');            
            Route::get('rep/add',[App\Http\Controllers\Admin\RepController::class, 'add'])->name('admin.rep.add');
            Route::get('rep/{item}',[App\Http\Controllers\Admin\RepController::class, 'show'])->name('admin.rep');
            Route::post('rep/store/{item?}',[App\Http\Controllers\Admin\RepController::class, 'store'])->name('admin.rep.store');
            Route::delete('rep/delete',[App\Http\Controllers\Admin\RepController::class, 'delete'])->name('admin.rep.delete');
            Route::post('rep/activate',[App\Http\Controllers\Admin\RepController::class, 'activate'])->name('admin.rep.activate');

            /******************* Supervisors ********************/                
            Route::get('supervisors',[App\Http\Controllers\Admin\SupervisorController::class, 'all'])->name('admin.supervisors');  
            Route::get('supervisor/add',[App\Http\Controllers\Admin\SupervisorController::class, 'add'])->name('admin.supervisor.add');
            Route::get('supervisor/{item}',[App\Http\Controllers\Admin\SupervisorController::class, 'show'])->name('admin.supervisor');
            Route::post('supervisor/store/{item?}',[App\Http\Controllers\Admin\SupervisorController::class, 'store'])->name('admin.supervisor.store');
            Route::delete('supervisor/delete',[App\Http\Controllers\Admin\SupervisorController::class, 'delete'])->name('admin.supervisor.delete');
            Route::post('supervisor/permissions/{item}',[App\Http\Controllers\Admin\SupervisorController::class, 'permissions'])->name('admin.supervisor.permissions');
            Route::post('supervisor/activate',[App\Http\Controllers\Admin\SupervisorController::class, 'activate'])->name('admin.supervisor.activate');

            /******************* Saudi ********************/                
            Route::get('saudis',[App\Http\Controllers\Admin\SaudiController::class, 'all'])->name('admin.saudis');                        
            Route::get('saudi/{item}',[App\Http\Controllers\Admin\SaudiController::class, 'show'])->name('admin.saudi');
            Route::post('saudi/store/{item?}',[App\Http\Controllers\Admin\SaudiController::class, 'store'])->name('admin.saudi.store');
            
            /*******************  Roles ********************/                
            Route::get('roles',[App\Http\Controllers\Admin\RoleController::class, 'all'])->name('admin.roles');                        
            Route::get('role/add',[App\Http\Controllers\Admin\RoleController::class, 'add'])->name('admin.role.add');
            Route::get('role/{item}',[App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('admin.role');
            Route::post('role/store/{item?}',[App\Http\Controllers\Admin\RoleController::class, 'store'])->name('admin.role.store');
            Route::delete('role/delete',[App\Http\Controllers\Admin\RoleController::class, 'delete'])->name('admin.role.delete');
            
            /************ Social  **********/
            Route::get('socials',[App\Http\Controllers\Admin\SocialController::class, 'all'])->name('admin.socials');                        
            Route::get('social/{item}',[App\Http\Controllers\Admin\SocialController::class, 'edit'])->name('admin.social');
            Route::post('social/store/{item?}',[App\Http\Controllers\Admin\SocialController::class, 'store'])->name('admin.social.store');
            Route::delete('social/delete',[App\Http\Controllers\Admin\SocialController::class, 'delete'])->name('admin.social.delete');


            /************ Settings  **********/
            Route::get('settings',[App\Http\Controllers\Admin\SettingController::class, 'all'])->name('admin.settings');                        
            Route::get('setting/{item}',[App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('admin.setting');
            Route::post('setting/store/{item?}',[App\Http\Controllers\Admin\SettingController::class, 'store'])->name('admin.setting.store');
            Route::delete('setting/delete',[App\Http\Controllers\Admin\SettingController::class, 'delete'])->name('admin.setting.delete');

            /************ Countries  **********/
            Route::get('countries',[App\Http\Controllers\Admin\CountryController::class, 'all'])->name('admin.countries');                
            Route::get('country/{item}',[App\Http\Controllers\Admin\CountryController::class, 'edit'])->name('admin.country');
            Route::post('country/store/{item?}',[App\Http\Controllers\Admin\CountryController::class, 'store'])->name('admin.country.store');
            Route::delete('country/delete',[App\Http\Controllers\Admin\CountryController::class, 'delete'])->name('admin.country.delete');
            Route::post('country/activate',[App\Http\Controllers\Admin\CountryController::class, 'activate'])->name('admin.country.activate');

            /************ Regions  **********/
            Route::get('regions/{item}',[App\Http\Controllers\Admin\RegionController::class, 'all'])->name('admin.regions');      
            Route::get('region/{item}',[App\Http\Controllers\Admin\RegionController::class, 'edit'])->name('admin.region');
            Route::post('region/store/{item?}',[App\Http\Controllers\Admin\RegionController::class, 'store'])->name('admin.region.store');
            Route::delete('region/delete',[App\Http\Controllers\Admin\RegionController::class, 'delete'])->name('admin.region.delete');
            Route::post('region/activate',[App\Http\Controllers\Admin\RegionController::class, 'activate'])->name('admin.region.activate');

            /************ Cities  **********/
            Route::get('cities/{item}',[App\Http\Controllers\Admin\CityController::class, 'all'])->name('admin.cities');      
            Route::get('city/{item}',[App\Http\Controllers\Admin\CityController::class, 'edit'])->name('admin.city');
            Route::post('city/store/{item?}',[App\Http\Controllers\Admin\CityController::class, 'store'])->name('admin.city.store');
            Route::delete('city/delete',[App\Http\Controllers\Admin\CityController::class, 'delete'])->name('admin.city.delete');
            Route::post('city/activate',[App\Http\Controllers\Admin\CityController::class, 'activate'])->name('admin.city.activate');



            Route::get('vip_requests',[App\Http\Controllers\Admin\VipRequestController::class, 'all'])->name('admin.vip_requests');            
             
 
            
            
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
 


