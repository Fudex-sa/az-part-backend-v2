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

        /*************** AJAX  **********************/
        Route::post('regions/load',[App\Http\Controllers\RegionController::class, 'all'])->name('regions.load');            
        Route::post('cities/load',[App\Http\Controllers\CityController::class, 'all'])->name('cities.load');            
        Route::post('models/load',[App\Http\Controllers\ModelController::class, 'all'])->name('models.load');            

        Route::group(['prefix'=> 'seller','namespace' => 'Seller','middleware'=>'seller'], function () {

            Route::get('avaliable_models',[App\Http\Controllers\Seller\AvliableModelController::class, 'index'])->name('seller.avaliable_models');

        });

         
        Route::group(['namespace' => 'Site'], function () {

            Route::get('/',[App\Http\Controllers\Site\HomeController::class, 'index'])->name('home');

            Route::get('cars/damaged',[App\Http\Controllers\Site\CarDamagedController::class, 'index'])->name('cars.damaged');

            Route::get('cars/antique',[App\Http\Controllers\Site\CarAntiqueController::class, 'index'])->name('cars.antique');

            Route::get('stock',[App\Http\Controllers\Site\StockController::class, 'index'])->name('stock');

            Route::get('packages',[App\Http\Controllers\Site\PackagesController::class, 'index'])->name('packages');

            Route::get('privacy',[App\Http\Controllers\Site\PageController::class, 'privacy'])->name('privacy');
            Route::get('terms',[App\Http\Controllers\Site\PageController::class, 'terms'])->name('terms');
            Route::get('about_us',[App\Http\Controllers\Site\PageController::class, 'about_us'])->name('about_us');
            

            Route::get('signup_as',[App\Http\Controllers\Site\AuthController::class, 'signup_as'])->name('signup_as');
            Route::get('login_as',[App\Http\Controllers\Site\AuthController::class, 'login_as'])->name('login_as');

            Route::post('user/login',[App\Http\Controllers\Site\AuthController::class, 'login'])->name('user.login');
            Route::get('user/forget_password',[App\Http\Controllers\Site\AuthController::class, 'forget_password'])->name('user.forget_password');
            Route::post('reset_password',[App\Http\Controllers\Site\AuthController::class, 'reset_password'])->name('reset_password');
            Route::get('logout',[App\Http\Controllers\Site\AuthController::class, 'logout'])->name('logout');

            Route::get('user/register',[App\Http\Controllers\Site\UserController::class, 'register'])->name('user.register');
            Route::post('user/signup',[App\Http\Controllers\Site\UserController::class, 'signup'])->name('user.signup');

            Route::get('seller/register',[App\Http\Controllers\Site\SellerController::class, 'register'])->name('seller.register');
            Route::post('seller/signup',[App\Http\Controllers\Site\SellerController::class, 'signup'])->name('seller.signup');

            Route::get('rep/register',[App\Http\Controllers\Site\RepController::class, 'register'])->name('rep.register');
            Route::post('rep/signup',[App\Http\Controllers\Site\RepController::class, 'signup'])->name('rep.signup');

            Route::get('verfication/{id}/{type}',[App\Http\Controllers\Site\VerficationController::class, 'index'])->name('verfication');
            Route::post('confirm/{id}/{type}',[App\Http\Controllers\Site\VerficationController::class, 'confirm'])->name('confirm');
            Route::get('resend_code/{id}/{type}',[App\Http\Controllers\Site\VerficationController::class, 'resend_code'])->name('resend_code');

            Route::post('contact_us',[App\Http\Controllers\Site\ContactUsController::class, 'index'])->name('contact_us');

            Route::get('profile',[App\Http\Controllers\Site\ProfileController::class, 'index'])->name('profile');
 
            Route::get('parts/search',[App\Http\Controllers\Site\PartController::class, 'search'])->name('search.parts');

        });
        
        Route::group(['prefix'=> 'admin','namespace' => 'Admin','middleware'=>'admin'], function () {

            Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

            Route::get('profile',[App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('admin.profile');            
            Route::post('profile/update',[App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');            

            Route::get('search',[App\Http\Controllers\Admin\SearchController::class, 'index'])->name('admin.search');            
 
            /*************** Packages  **********************/
            Route::get('packages',[App\Http\Controllers\Admin\PackageController::class, 'index'])->name('admin.packages');            
            Route::post('package/{id?}',[App\Http\Controllers\Admin\PackageController::class, 'store'])->name('admin.package.store');
            Route::get('package/{item}',[App\Http\Controllers\Admin\PackageController::class, 'edit'])->name('admin.package');            
            Route::delete('package/delete',[App\Http\Controllers\Admin\PackageController::class, 'delete'])->name('admin.package.delete');            

            /******************* Users ********************/                
            Route::get('user/search',[App\Http\Controllers\Admin\UserController::class, 'search'])->name('admin.user.search');
            Route::get('users',[App\Http\Controllers\Admin\UserController::class, 'all'])->name('admin.users');            
            Route::get('user/add',[App\Http\Controllers\Admin\UserController::class, 'add'])->name('admin.user.add');            
            Route::get('user/{item}',[App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.user');
            Route::post('user/store/{id?}',[App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.user.store');            
            Route::delete('user/delete',[App\Http\Controllers\Admin\UserController::class, 'delete'])->name('admin.user.delete');
            Route::post('user/activate',[App\Http\Controllers\Admin\UserController::class, 'activate'])->name('admin.user.activate');
            

            /******************* Companies ********************/    
            Route::get('company/search',[App\Http\Controllers\Admin\CompanyController::class, 'search'])->name('admin.company.search');
            Route::get('companies',[App\Http\Controllers\Admin\CompanyController::class, 'all'])->name('admin.companies');
            Route::get('company/add',[App\Http\Controllers\Admin\CompanyController::class, 'add'])->name('admin.company.add');
            Route::get('company/{item}',[App\Http\Controllers\Admin\CompanyController::class, 'show'])->name('admin.company');
            Route::post('company/store/{item?}',[App\Http\Controllers\Admin\CompanyController::class, 'store'])->name('admin.company.store');
            Route::delete('company/delete',[App\Http\Controllers\Admin\CompanyController::class, 'delete'])->name('admin.company.delete');
            Route::post('company/activate',[App\Http\Controllers\Admin\CompanyController::class, 'activate'])->name('admin.company.activate');

            /******************* Sellers ********************/    
            Route::get('seller/search',[App\Http\Controllers\Admin\SellerController::class, 'search'])->name('admin.seller.search');
            Route::get('sellers',[App\Http\Controllers\Admin\SellerController::class, 'all'])->name('admin.sellers');            
            Route::get('seller/add',[App\Http\Controllers\Admin\SellerController::class, 'add'])->name('admin.seller.add');
            Route::get('seller/{item}',[App\Http\Controllers\Admin\SellerController::class, 'show'])->name('admin.seller');
            Route::post('seller/store/{item?}',[App\Http\Controllers\Admin\SellerController::class, 'store'])->name('admin.seller.store');
            Route::delete('seller/delete',[App\Http\Controllers\Admin\SellerController::class, 'delete'])->name('admin.seller.delete');
            Route::post('seller/activate',[App\Http\Controllers\Admin\SellerController::class, 'activate'])->name('admin.seller.activate');

            /******************* Brokers ********************/    
            Route::get('broker/search',[App\Http\Controllers\Admin\BrokerController::class, 'search'])->name('admin.broker.search');
            Route::get('brokers',[App\Http\Controllers\Admin\BrokerController::class, 'all'])->name('admin.brokers');            
            Route::get('broker/add',[App\Http\Controllers\Admin\BrokerController::class, 'add'])->name('admin.broker.add');
            Route::get('broker/{item}',[App\Http\Controllers\Admin\BrokerController::class, 'show'])->name('admin.broker');
            Route::post('broker/store/{item?}',[App\Http\Controllers\Admin\BrokerController::class, 'store'])->name('admin.broker.store');
            Route::delete('broker/delete',[App\Http\Controllers\Admin\BrokerController::class, 'delete'])->name('admin.broker.delete');
            Route::post('broker/activate',[App\Http\Controllers\Admin\BrokerController::class, 'activate'])->name('admin.broker.activate');

            /******************* Reps ********************/                
            Route::get('rep/search',[App\Http\Controllers\Admin\RepController::class, 'search'])->name('admin.rep.search');
            Route::get('reps',[App\Http\Controllers\Admin\RepController::class, 'all'])->name('admin.reps');            
            Route::get('rep/add',[App\Http\Controllers\Admin\RepController::class, 'add'])->name('admin.rep.add');
            Route::get('rep/{item}',[App\Http\Controllers\Admin\RepController::class, 'show'])->name('admin.rep');
            Route::post('rep/store/{item?}',[App\Http\Controllers\Admin\RepController::class, 'store'])->name('admin.rep.store');
            Route::delete('rep/delete',[App\Http\Controllers\Admin\RepController::class, 'delete'])->name('admin.rep.delete');
            Route::post('rep/activate',[App\Http\Controllers\Admin\RepController::class, 'activate'])->name('admin.rep.activate');

            /******************* Supervisors ********************/                
            Route::get('supervisor/search',[App\Http\Controllers\Admin\SupervisorController::class, 'search'])->name('admin.supervisor.search');
            Route::get('supervisors',[App\Http\Controllers\Admin\SupervisorController::class, 'all'])->name('admin.supervisors');  
            Route::get('supervisor/add',[App\Http\Controllers\Admin\SupervisorController::class, 'add'])->name('admin.supervisor.add');
            Route::get('supervisor/{item}',[App\Http\Controllers\Admin\SupervisorController::class, 'show'])->name('admin.supervisor');
            Route::post('supervisor/store/{item?}',[App\Http\Controllers\Admin\SupervisorController::class, 'store'])->name('admin.supervisor.store');
            Route::delete('supervisor/delete',[App\Http\Controllers\Admin\SupervisorController::class, 'delete'])->name('admin.supervisor.delete');
            Route::post('supervisor/permissions/{item}',[App\Http\Controllers\Admin\SupervisorController::class, 'permissions'])->name('admin.supervisor.permissions');
            Route::post('supervisor/activate',[App\Http\Controllers\Admin\SupervisorController::class, 'activate'])->name('admin.supervisor.activate');
            Route::post('supervisor/cities/{item}',[App\Http\Controllers\Admin\SupervisorController::class, 'cities'])->name('admin.supervisor.cities');
            
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
            Route::post('social/activate',[App\Http\Controllers\Admin\SocialController::class, 'activate'])->name('admin.social.activate');

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

            /************ Brands  **********/
            Route::get('brand/search',[App\Http\Controllers\Admin\BrandController::class, 'search'])->name('admin.brand.search');      
            Route::get('brands',[App\Http\Controllers\Admin\BrandController::class, 'all'])->name('admin.brands');                        
            Route::get('brand/{item}',[App\Http\Controllers\Admin\BrandController::class, 'edit'])->name('admin.brand');
            Route::post('brand/store/{item?}',[App\Http\Controllers\Admin\BrandController::class, 'store'])->name('admin.brand.store');
            Route::delete('brand/delete',[App\Http\Controllers\Admin\BrandController::class, 'delete'])->name('admin.brand.delete');
            Route::post('brand/activate',[App\Http\Controllers\Admin\BrandController::class, 'activate'])->name('admin.brand.activate');

            /************ Models  **********/
            Route::get('models/{brand}',[App\Http\Controllers\Admin\ModelController::class, 'all'])->name('admin.models');      
            Route::get('model/{item}',[App\Http\Controllers\Admin\ModelController::class, 'edit'])->name('admin.model');
            Route::post('model/store/{item?}',[App\Http\Controllers\Admin\ModelController::class, 'store'])->name('admin.model.store');
            Route::delete('model/delete',[App\Http\Controllers\Admin\ModelController::class, 'delete'])->name('admin.model.delete');
            Route::post('model/activate',[App\Http\Controllers\Admin\ModelController::class, 'activate'])->name('admin.model.activate');

            /************* Pieces *******************/     
            Route::get('piece/search',[App\Http\Controllers\Admin\PieceController::class, 'search'])->name('admin.piece.search');      
            Route::get('pieces',[App\Http\Controllers\Admin\PieceController::class, 'all'])->name('admin.pieces');      
            Route::get('piece/{id}',[App\Http\Controllers\Admin\PieceController::class, 'edit'])->name('admin.piece');      
            Route::post('piece/store/{item?}',[App\Http\Controllers\Admin\PieceController::class, 'store'])->name('admin.piece.store');      
            Route::delete('piece/delete',[App\Http\Controllers\Admin\PieceController::class, 'delete'])->name('admin.piece.delete');      
            
            Route::post('alt/store/{piece}',[App\Http\Controllers\Admin\PieceController::class, 'store_alts'])->name('admin.alt.store');      
            Route::delete('alt/delete',[App\Http\Controllers\Admin\PieceController::class, 'delete_alt'])->name('admin.alt.delete');      
            Route::post('alt/update/{alt}',[App\Http\Controllers\Admin\PieceController::class, 'update_alt'])->name('admin.alt.update');      

            /************ Bad Words  **********/
            Route::get('badwords',[App\Http\Controllers\Admin\BadWordController::class, 'all'])->name('admin.badwords');                        
            Route::get('badword/{item}',[App\Http\Controllers\Admin\BadWordController::class, 'edit'])->name('admin.badword');
            Route::post('badword/store/{item?}',[App\Http\Controllers\Admin\BadWordController::class, 'store'])->name('admin.badword.store');
            Route::delete('badword/delete',[App\Http\Controllers\Admin\BadWordController::class, 'delete'])->name('admin.badword.delete');
              

            /************* Contact Us *******************/
            Route::get('contact-us',[App\Http\Controllers\Admin\ContactUsController::class, 'all'])->name('admin.contact_us');                        
            Route::get('contact-us/{item}',[App\Http\Controllers\Admin\ContactUsController::class, 'show'])->name('admin.contact_us.show');                        
            Route::delete('contact-us/delete',[App\Http\Controllers\Admin\ContactUsController::class, 'delete'])->name('admin.contact_us.delete');                        
 
            /************* Pages *******************/
            Route::get('page/{item}',[App\Http\Controllers\Admin\PageController::class, 'edit'])->name('admin.page');                        
            Route::post('page/store/{item}',[App\Http\Controllers\Admin\PageController::class, 'store'])->name('admin.page.store');                        
 
            /************** Slider ***************************/
            Route::get('sliders',[App\Http\Controllers\Admin\SliderController::class, 'all'])->name('admin.sliders');                        
            Route::get('slider/{item}',[App\Http\Controllers\Admin\SliderController::class, 'edit'])->name('admin.slider');                        
            Route::post('slider/store/{item?}',[App\Http\Controllers\Admin\SliderController::class, 'store'])->name('admin.slider.store');                        
            Route::delete('slider/delete',[App\Http\Controllers\Admin\SliderController::class, 'delete'])->name('admin.slider.delete');                        
            Route::post('slider/activate',[App\Http\Controllers\Admin\SliderController::class, 'activate'])->name('admin.slider.activate');

            /************* Ads *******************/
            Route::get('ads',[App\Http\Controllers\Admin\AdController::class, 'all'])->name('admin.ads');                        
            Route::get('ad/{item}',[App\Http\Controllers\Admin\AdController::class, 'edit'])->name('admin.ad');                        
            Route::post('ad/store/{item?}',[App\Http\Controllers\Admin\AdController::class, 'store'])->name('admin.ad.store');                        
            Route::delete('ad/delete',[App\Http\Controllers\Admin\AdController::class, 'delete'])->name('admin.ad.delete');     
            Route::post('ad/activate',[App\Http\Controllers\Admin\AdController::class, 'activate'])->name('admin.ad.activate');                   
 
            /*************** Notifications  **********************/
            Route::get('notifications',[App\Http\Controllers\Admin\NotificationController::class, 'all'])->name('admin.notifications');                        
            Route::get('notification/{item}',[App\Http\Controllers\Admin\NotificationController::class, 'edit'])->name('admin.notification');                        
            Route::post('notification/store/{item?}',[App\Http\Controllers\Admin\NotificationController::class, 'store'])->name('admin.notification.store');                        
            Route::delete('notification/delete',[App\Http\Controllers\Admin\NotificationController::class, 'delete'])->name('admin.notification.delete');                        



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

            

            

        });

});
 


