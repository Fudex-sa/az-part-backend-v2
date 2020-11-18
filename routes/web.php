<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],
    function () {

        /*************** Admin Auth  **********************/
        Route::get('admin', [App\Http\Controllers\Admin\LoginController::class, 'index'])->name('admin');
        Route::post('admin/login', [App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login');
        Route::post('admin/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');

        /*************** AJAX  **********************/
        Route::post('regions/load', [App\Http\Controllers\AjaxController::class, 'regions'])->name('regions.load');
        Route::post('cities/load', [App\Http\Controllers\AjaxController::class, 'cities'])->name('cities.load');
        Route::post('models/load', [App\Http\Controllers\AjaxController::class, 'models'])->name('models.load');
        Route::post('reps/load', [App\Http\Controllers\AjaxController::class, 'reps'])->name('reps.load');
        Route::post('rep/choose', [App\Http\Controllers\AjaxController::class, 'rep_choose'])->name('rep.choose');
        Route::post('with_oil', [App\Http\Controllers\AjaxController::class, 'with_oil'])->name('with_oil');


        Route::group(['prefix'=> 'seller','namespace' => 'Seller','middleware'=>'seller'], function () {
            Route::get('avaliable_models', [App\Http\Controllers\Seller\AvliableModelController::class, 'index'])->name('seller.avaliable_models');
            Route::post('avaliable_model/{id?}', [App\Http\Controllers\Seller\AvliableModelController::class, 'store'])->name('seller.avaliable_model.store');
            Route::get('avaliable_model/{item}', [App\Http\Controllers\Seller\AvliableModelController::class, 'edit'])->name('seller.avaliable_model');
            Route::delete('avaliable_model/delete', [App\Http\Controllers\Seller\AvliableModelController::class, 'delete'])->name('admin.avaliable_model.delete');

            Route::get('requests', [App\Http\Controllers\Seller\RequestsController::class, 'all'])->name('seller.requests');
            Route::post('request/update/{item}', [App\Http\Controllers\Seller\RequestsController::class, 'update'])->name('seller.request.update');
            Route::get('request/add_price/{id}', [App\Http\Controllers\Seller\RequestsController::class, 'add_price'])->name('seller.add_price');
            Route::post('request/send_price/{id}', [App\Http\Controllers\Seller\RequestsController::class, 'send_price'])->name('seller.send_price');
        });


        Route::group(['prefix'=> 'rep','namespace' => 'Rep','middleware'=>'rep'], function () {
            Route::post('my_price/activate', [App\Http\Controllers\Rep\MyPricesController::class, 'activate'])->name('admin.my_price.activate');
            Route::get('my_prices', [App\Http\Controllers\Rep\MyPricesController::class, 'index'])->name('rep.my_prices');
            Route::post('my_price/{id?}', [App\Http\Controllers\Rep\MyPricesController::class, 'store'])->name('rep.my_price.store');
            Route::get('my_price/{id}', [App\Http\Controllers\Rep\MyPricesController::class, 'edit'])->name('rep.my_price');
            Route::delete('my_price/delete', [App\Http\Controllers\Rep\MyPricesController::class, 'delete'])->name('admin.my_price.delete');



            Route::get('my_orders', [App\Http\Controllers\Rep\MyOrderController::class, 'all'])->name('rep.my_orders');
            Route::post('order/update/{id}', [App\Http\Controllers\Rep\MyOrderController::class, 'update'])->name('rep.order.update');
        });


        Route::group(['prefix'=> 'user','namespace' => 'User'], function () {
            Route::get('my_orders', [App\Http\Controllers\User\MyOrderController::class, 'index'])->name('user.my_orders')->middleware('userOrders');

            Route::post('rate', [App\Http\Controllers\User\RateController::class, 'index'])->name('rate');
        });

        Route::group(['prefix'=> 'control','namespace' => 'Control','middleware'=>'isLogged'], function () {
            Route::get('notifications', [App\Http\Controllers\Control\NotificationController::class, 'index'])->name('notification.all');
            Route::get('deleteNotification/{id?}', [App\Http\Controllers\Control\NotificationController::class, 'delete'])->name('notification.delete');


            Route::get('profile', [App\Http\Controllers\Control\ProfileController::class, 'index'])->name('profile');
            Route::post('profile/update', [App\Http\Controllers\Control\ProfileController::class, 'update'])->name('profile.update');

            Route::get('my_packages', [App\Http\Controllers\Control\MyPackageController::class, 'index'])->name('my_packages')->middleware('myPackages');

            Route::get('order/{id}', [App\Http\Controllers\Control\OrderController::class, 'show'])->name('order');

            Route::get('cars', [App\Http\Controllers\Control\CarController::class, 'all'])->name('control.cars');
            Route::get('car/{item}', [App\Http\Controllers\Control\CarController::class, 'edit'])->name('control.car');
            Route::post('car/store/{id?}', [App\Http\Controllers\Control\CarController::class, 'store'])->name('control.car.store');
            Route::delete('car/delete', [App\Http\Controllers\Control\CarController::class, 'delete'])->name('admin.car.delete');
            Route::delete('car/img/delete', [App\Http\Controllers\Control\CarController::class, 'car_img_delete'])->name('admin.car_img.delete');

            Route::get('user_interests', [App\Http\Controllers\Control\UserInterestsController::class, 'index'])->name('control.user_interests');
            Route::post('user_interests/store/{id?}', [App\Http\Controllers\Control\UserInterestsController::class, 'store'])->name('control.user_interests.store');
            Route::get('user_interest/{item}', [App\Http\Controllers\Control\UserInterestsController::class, 'edit'])->name('control.user_interest');
            Route::get('user_interest/delete/{id?}', [App\Http\Controllers\Control\UserInterestsController::class, 'delete'])->name('control.user_interest.delete');


            Route::get('wishlist/add/{id?}', [App\Http\Controllers\Control\CarFavoritesController::class, 'add_wish_list'])->name('control.wishlist.add_wish_list');
            Route::get('wishlist/delete/{id?}', [App\Http\Controllers\Control\CarFavoritesController::class, 'remove_wish_list'])->name('control.wishlist.remove_wish_list');
            Route::get('wishlists', [App\Http\Controllers\Control\CarFavoritesController::class, 'wish_list'])->name('control.wish_list');


            Route::get('get_auction/{item}', [App\Http\Controllers\Control\CarsBiddingController::class, 'index'])->name('control.getAuction');
            Route::post('car/bindding/{item?}', [App\Http\Controllers\Control\CarsBiddingController::class, 'storeBidding'])->name('control.carStoreBidding');

            Route::get('requests/all', [App\Http\Controllers\Control\MyRequestsController::class, 'all'])->name('my_requests');
            Route::get('request/offers/{id}', [App\Http\Controllers\Control\MyRequestsController::class, 'offers'])->name('request.offers');
            Route::get('request/edit/{item}', [App\Http\Controllers\Control\MyRequestsController::class, 'edit'])->name('request.edit');
            Route::delete('my_requests/delete', [App\Http\Controllers\Control\MyRequestsController::class, 'delete'])->name('admin.my_request.delete');

            Route::get('offer/add_to_cart/{id}', [App\Http\Controllers\Control\OfferController::class, 'add_to_cart'])->name('offer.add_to_cart');
            Route::get('request/{item}', [App\Http\Controllers\Control\RequestsController::class, 'show'])->name('request.show');
        });


        Route::group(['namespace' => 'Site'], function () {
            Route::get('/', [App\Http\Controllers\Site\HomeController::class, 'index'])->name('home');

            Route::get('cars/damaged', [App\Http\Controllers\Site\CarController::class, 'damaged'])->name('cars.damaged');
            Route::get('cars/antique', [App\Http\Controllers\Site\CarController::class, 'antique'])->name('cars.antique');
            Route::get('car/{id}', [App\Http\Controllers\Site\CarController::class, 'show'])->name('car');
            Route::get('cars/search', [App\Http\Controllers\Site\CarController::class, 'search'])->name('cars.search');
            Route::post('car/comment/store/{id}', [App\Http\Controllers\Site\CarController::class, 'store_comment'])->name('car.comment.store');

            Route::get('stock', [App\Http\Controllers\Site\StockController::class, 'index'])->name('stock');
            Route::get('stock/filter', [App\Http\Controllers\Site\StockController::class, 'filter'])->name('stock.filter');

            Route::get('package/{type}', [App\Http\Controllers\Site\PackageController::class, 'show'])->name('package.show');
            Route::get('package/subscribe/{id}', [App\Http\Controllers\Site\PackageController::class, 'subscribe'])->name('package.subscribe')->middleware('userOrders');


            Route::get('privacy', [App\Http\Controllers\Site\PageController::class, 'privacy'])->name('privacy');
            Route::get('terms', [App\Http\Controllers\Site\PageController::class, 'terms'])->name('terms');
            Route::get('about_us', [App\Http\Controllers\Site\PageController::class, 'about_us'])->name('about_us');


            Route::get('signup_as', [App\Http\Controllers\Site\AuthController::class, 'signup_as'])->name('signup_as');
            Route::get('login_as', [App\Http\Controllers\Site\AuthController::class, 'login_as'])->name('login_as');

            Route::get('user/login', [App\Http\Controllers\Site\AuthController::class, 'signin'])->name('user.signin')->middleware('guest');
            Route::post('user/login', [App\Http\Controllers\Site\AuthController::class, 'login'])->name('user.login');
            Route::get('user/forget_password', [App\Http\Controllers\Site\AuthController::class, 'forget_password'])->name('user.forget_password');
            Route::post('reset_password', [App\Http\Controllers\Site\AuthController::class, 'reset_password'])->name('reset_password');
            Route::get('logout', [App\Http\Controllers\Site\AuthController::class, 'logout'])->name('logout');

            Route::get('user/register', [App\Http\Controllers\Site\UserController::class, 'register'])->name('user.register');
            Route::post('user/signup', [App\Http\Controllers\Site\UserController::class, 'signup'])->name('user.signup');

            Route::get('seller/register', [App\Http\Controllers\Site\SellerController::class, 'register'])->name('seller.register');
            Route::post('seller/signup', [App\Http\Controllers\Site\SellerController::class, 'signup'])->name('seller.signup');

            Route::get('rep/register', [App\Http\Controllers\Site\RepController::class, 'register'])->name('rep.register');
            Route::post('rep/signup', [App\Http\Controllers\Site\RepController::class, 'signup'])->name('rep.signup');

            Route::get('verfication/{id}/{type}', [App\Http\Controllers\Site\VerficationController::class, 'index'])->name('verfication');
            Route::post('confirm/{id}/{type}', [App\Http\Controllers\Site\VerficationController::class, 'confirm'])->name('confirm');
            Route::get('resend_code/{id}/{type}', [App\Http\Controllers\Site\VerficationController::class, 'resend_code'])->name('resend_code');

            Route::post('contact_us', [App\Http\Controllers\Site\ContactUsController::class, 'index'])->name('contact_us');

            Route::get('parts/search', [App\Http\Controllers\Site\PartController::class, 'search'])->name('search.parts')->middleware('isLogged');
            Route::post('contact_seller', [App\Http\Controllers\Site\PartController::class, 'addToCart'])->name('addToCart')->middleware('userOrders');
            Route::get('report/{id}', [App\Http\Controllers\Site\PartController::class, 'report'])->name('report')->middleware('userOrders');
            Route::post('report', [App\Http\Controllers\Site\PartController::class, 'send_report'])->name('send_report')->middleware('userOrders');
            Route::get('more_pieces', [App\Http\Controllers\Site\PartController::class, 'more_pieces'])->name('more_pieces')->middleware('userOrders');
            Route::post('create_request', [App\Http\Controllers\Site\ElectronicController::class, 'create_request'])->name('create_request')->middleware('userOrders');
            Route::get('search/change/{city}', [App\Http\Controllers\Site\PartController::class, 'change_search'])->name('search.change')->middleware('isLogged');

            Route::get('cart', [App\Http\Controllers\Site\CartController::class, 'index'])->name('cart')->middleware('userOrders');
            Route::delete('cart/delete', [App\Http\Controllers\Site\CartController::class, 'delete'])->name('admin.cart.delete');
            Route::post('coupon/use', [App\Http\Controllers\Site\CartController::class, 'use_coupon'])->name('coupon.use')->middleware('isLogged');

            Route::get('reps', [App\Http\Controllers\Site\ShippingController::class, 'reps'])->name('reps')->middleware('isLogged');
            Route::get('reps/filter', [App\Http\Controllers\Site\ShippingController::class, 'reps_filter'])->name('reps.filter')->middleware('isLogged');
            Route::get('choose_rep/{rep_id}/{price}', [App\Http\Controllers\Site\ShippingController::class, 'choose_rep'])->name('choose_rep')->middleware('isLogged');

            Route::get('shipping', [App\Http\Controllers\Site\ShippingController::class, 'index'])->name('shipping')->middleware('isLogged');
            Route::post('shipping', [App\Http\Controllers\Site\ShippingController::class, 'store_shipping'])->name('shipping.save')->middleware('isLogged');
            Route::get('payment/method/{type}', [App\Http\Controllers\Site\PaymentController::class, 'payment_method'])->name('payment.method')->middleware('isLogged');
            Route::get('payment/choose', [App\Http\Controllers\Site\PaymentController::class, 'choose'])->name('payment.choose')->middleware('isLogged');
            Route::get('payment', [App\Http\Controllers\Site\PaymentController::class, 'index'])->name('payment')->middleware('isLogged');
            Route::get(
                '/resourcePath=/v1/checkouts/{checkoutId}/payment',
                [App\Http\Controllers\Site\PaymentController::class, 'pay_response']
            )->name('pay_response')->middleware('isLogged');
        });

        Route::group(['prefix'=> 'admin','namespace' => 'Admin','middleware'=>'admin'], function () {
            Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

            Route::get('profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('admin.profile');
            Route::post('profile/update', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');

            Route::get('search', [App\Http\Controllers\Admin\SearchController::class, 'index'])->name('admin.search');

            /*************** Orders  **********************/
            Route::get('orders/search', [App\Http\Controllers\Admin\OrderController::class, 'search'])->name('admin.orders.search');
            Route::get('orders', [App\Http\Controllers\Admin\OrderController::class, 'all'])->name('admin.orders');
            Route::get('orders/deleted', [App\Http\Controllers\Admin\OrderController::class, 'deleted'])->name('admin.orders.deleted');
            Route::get('order/{id}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.order');
            Route::delete('order/delete', [App\Http\Controllers\Admin\OrderController::class, 'delete'])->name('admin.order.delete');
            Route::post('order/update/{id}', [App\Http\Controllers\Admin\OrderController::class, 'update'])->name('admin.order.update');


            /*************** Electronic Engine  **********************/

            Route::get('orders/electronic/engine', [App\Http\Controllers\Admin\ElecEngineController::class, 'all'])->name('admin.electronic.engine');
            Route::get('orders/electronic/{id}', [App\Http\Controllers\Admin\ElecEngineController::class, 'show'])->name('admin.elec_order');
            Route::get('order/engine/{id}', [App\Http\Controllers\Admin\ElecEngineController::class, 'engine'])->name('admin.order.engine');
            Route::delete('order/electronic/delete', [App\Http\Controllers\Admin\ElecEngineController::class, 'delete'])->name('admin.electronic.delete');
            Route::get('engine/edit/{id}', [App\Http\Controllers\Admin\ElecEngineController::class, 'edit'])->name('admin.engine.edit');
            Route::post('engine/update/{id}', [App\Http\Controllers\Admin\ElecEngineController::class, 'update'])->name('admin.engine.update');
            Route::post('engine/update_order/{id}', [App\Http\Controllers\Admin\ElecEngineController::class, 'update_order'])->name('admin.engine.update_order');

            /*************** Orders Reports  **********************/
            Route::get('reports', [App\Http\Controllers\Admin\ReportController::class, 'all'])->name('admin.reports');
            Route::delete('report/delete', [App\Http\Controllers\Admin\ReportController::class, 'delete'])->name('admin.report.delete');

            /*************** Packages  **********************/
            Route::get('packages', [App\Http\Controllers\Admin\PackageController::class, 'index'])->name('admin.packages');
            Route::post('package/{id?}', [App\Http\Controllers\Admin\PackageController::class, 'store'])->name('admin.package.store');
            Route::get('package/{item}', [App\Http\Controllers\Admin\PackageController::class, 'edit'])->name('admin.package');
            Route::delete('package/delete', [App\Http\Controllers\Admin\PackageController::class, 'delete'])->name('admin.package.delete');

            /******************* Users ********************/
            Route::get('user/search', [App\Http\Controllers\Admin\UserController::class, 'search'])->name('admin.user.search');
            Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'all'])->name('admin.users');
            Route::get('user/add', [App\Http\Controllers\Admin\UserController::class, 'add'])->name('admin.user.add');
            Route::get('user/{item}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.user');
            Route::post('user/store/{id?}', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.user.store');
            Route::delete('user/delete', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('admin.user.delete');
            Route::post('user/activate', [App\Http\Controllers\Admin\UserController::class, 'activate'])->name('admin.user.activate');


            /******************* Companies ********************/
            Route::get('company/search', [App\Http\Controllers\Admin\CompanyController::class, 'search'])->name('admin.company.search');
            Route::get('companies', [App\Http\Controllers\Admin\CompanyController::class, 'all'])->name('admin.companies');
            Route::get('company/add', [App\Http\Controllers\Admin\CompanyController::class, 'add'])->name('admin.company.add');
            Route::get('company/{item}', [App\Http\Controllers\Admin\CompanyController::class, 'show'])->name('admin.company');
            Route::post('company/store/{item?}', [App\Http\Controllers\Admin\CompanyController::class, 'store'])->name('admin.company.store');
            Route::delete('company/delete', [App\Http\Controllers\Admin\CompanyController::class, 'delete'])->name('admin.company.delete');
            Route::post('company/activate', [App\Http\Controllers\Admin\CompanyController::class, 'activate'])->name('admin.company.activate');

            /******************* Sellers ********************/
            Route::get('seller/search', [App\Http\Controllers\Admin\SellerController::class, 'search'])->name('admin.seller.search');
            Route::get('sellers', [App\Http\Controllers\Admin\SellerController::class, 'all'])->name('admin.sellers');
            Route::get('seller/add', [App\Http\Controllers\Admin\SellerController::class, 'add'])->name('admin.seller.add');
            Route::get('seller/{item}', [App\Http\Controllers\Admin\SellerController::class, 'show'])->name('admin.seller');
            Route::post('seller/store/{item?}', [App\Http\Controllers\Admin\SellerController::class, 'store'])->name('admin.seller.store');
            Route::delete('seller/delete', [App\Http\Controllers\Admin\SellerController::class, 'delete'])->name('admin.seller.delete');
            Route::post('seller/activate', [App\Http\Controllers\Admin\SellerController::class, 'activate'])->name('admin.seller.activate');
            Route::post('available_brand/store', [App\Http\Controllers\Admin\SellerController::class, 'available_brand_store'])->name('admin.available_brand.store');

            /******************* Brokers ********************/
            Route::get('broker/search', [App\Http\Controllers\Admin\BrokerController::class, 'search'])->name('admin.broker.search');
            Route::get('brokers', [App\Http\Controllers\Admin\BrokerController::class, 'all'])->name('admin.brokers');
            Route::get('broker/add', [App\Http\Controllers\Admin\BrokerController::class, 'add'])->name('admin.broker.add');
            Route::get('broker/{item}', [App\Http\Controllers\Admin\BrokerController::class, 'show'])->name('admin.broker');
            Route::post('broker/store/{item?}', [App\Http\Controllers\Admin\BrokerController::class, 'store'])->name('admin.broker.store');
            Route::delete('broker/delete', [App\Http\Controllers\Admin\BrokerController::class, 'delete'])->name('admin.broker.delete');
            Route::post('broker/activate', [App\Http\Controllers\Admin\BrokerController::class, 'activate'])->name('admin.broker.activate');

            /******************* Reps ********************/
            Route::get('rep/search', [App\Http\Controllers\Admin\RepController::class, 'search'])->name('admin.rep.search');
            Route::get('reps', [App\Http\Controllers\Admin\RepController::class, 'all'])->name('admin.reps');
            Route::get('rep/add', [App\Http\Controllers\Admin\RepController::class, 'add'])->name('admin.rep.add');
            Route::get('rep/{item}', [App\Http\Controllers\Admin\RepController::class, 'show'])->name('admin.rep');
            Route::post('rep/store/{item?}', [App\Http\Controllers\Admin\RepController::class, 'store'])->name('admin.rep.store');
            Route::delete('rep/delete', [App\Http\Controllers\Admin\RepController::class, 'delete'])->name('admin.rep.delete');
            Route::post('rep/activate', [App\Http\Controllers\Admin\RepController::class, 'activate'])->name('admin.rep.activate');

            Route::post('rep_price/store', [App\Http\Controllers\Admin\RepController::class, 'price_store'])->name('admin.rep_price.store');
            Route::delete('rep_price/delete', [App\Http\Controllers\Admin\RepController::class, 'price_delete'])->name('admin.rep_price.delete');
            /******************* Supervisors ********************/
            Route::get('supervisor/search', [App\Http\Controllers\Admin\SupervisorController::class, 'search'])->name('admin.supervisor.search');
            Route::get('supervisors', [App\Http\Controllers\Admin\SupervisorController::class, 'all'])->name('admin.supervisors');
            Route::get('supervisor/add', [App\Http\Controllers\Admin\SupervisorController::class, 'add'])->name('admin.supervisor.add');
            Route::get('supervisor/{item}', [App\Http\Controllers\Admin\SupervisorController::class, 'show'])->name('admin.supervisor');
            Route::post('supervisor/store/{item?}', [App\Http\Controllers\Admin\SupervisorController::class, 'store'])->name('admin.supervisor.store');
            Route::delete('supervisor/delete', [App\Http\Controllers\Admin\SupervisorController::class, 'delete'])->name('admin.supervisor.delete');
            Route::post('supervisor/permissions/{item}', [App\Http\Controllers\Admin\SupervisorController::class, 'permissions'])->name('admin.supervisor.permissions');
            Route::post('supervisor/activate', [App\Http\Controllers\Admin\SupervisorController::class, 'activate'])->name('admin.supervisor.activate');
            Route::post('supervisor/cities/{item}', [App\Http\Controllers\Admin\SupervisorController::class, 'cities'])->name('admin.supervisor.cities');

            /******************* Saudi ********************/
            Route::get('saudis', [App\Http\Controllers\Admin\SaudiController::class, 'all'])->name('admin.saudis');
            Route::get('saudi/{item}', [App\Http\Controllers\Admin\SaudiController::class, 'show'])->name('admin.saudi');
            Route::post('saudi/store/{item?}', [App\Http\Controllers\Admin\SaudiController::class, 'store'])->name('admin.saudi.store');

            /*******************  Roles ********************/
            Route::get('roles', [App\Http\Controllers\Admin\RoleController::class, 'all'])->name('admin.roles');
            Route::get('role/add', [App\Http\Controllers\Admin\RoleController::class, 'add'])->name('admin.role.add');
            Route::get('role/{item}', [App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('admin.role');
            Route::post('role/store/{item?}', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('admin.role.store');
            Route::delete('role/delete', [App\Http\Controllers\Admin\RoleController::class, 'delete'])->name('admin.role.delete');

            /************ Social  **********/
            Route::get('socials', [App\Http\Controllers\Admin\SocialController::class, 'all'])->name('admin.socials');
            Route::get('social/{item}', [App\Http\Controllers\Admin\SocialController::class, 'edit'])->name('admin.social');
            Route::post('social/store/{item?}', [App\Http\Controllers\Admin\SocialController::class, 'store'])->name('admin.social.store');
            Route::delete('social/delete', [App\Http\Controllers\Admin\SocialController::class, 'delete'])->name('admin.social.delete');
            Route::post('social/activate', [App\Http\Controllers\Admin\SocialController::class, 'activate'])->name('admin.social.activate');

            /************ Settings  **********/
            Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'all'])->name('admin.settings');
            Route::get('setting/{item}', [App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('admin.setting');
            Route::post('setting/store/{item?}', [App\Http\Controllers\Admin\SettingController::class, 'store'])->name('admin.setting.store');
            Route::delete('setting/delete', [App\Http\Controllers\Admin\SettingController::class, 'delete'])->name('admin.setting.delete');

            /************ Data Site  **********/
            Route::get('data_sites', [App\Http\Controllers\Admin\DataSiteController::class, 'all'])->name('admin.data_sites');
            Route::get('data_site/{item}', [App\Http\Controllers\Admin\DataSiteController::class, 'edit'])->name('admin.data_site');
            Route::post('data_site/store/{item?}', [App\Http\Controllers\Admin\DataSiteController::class, 'store'])->name('admin.data_site.store');
            Route::delete('data_site/delete', [App\Http\Controllers\Admin\DataSiteController::class, 'delete'])->name('admin.data_site.delete');

            /************ Countries  **********/
            Route::get('countries', [App\Http\Controllers\Admin\CountryController::class, 'all'])->name('admin.countries');
            Route::get('country/{item}', [App\Http\Controllers\Admin\CountryController::class, 'edit'])->name('admin.country');
            Route::post('country/store/{item?}', [App\Http\Controllers\Admin\CountryController::class, 'store'])->name('admin.country.store');
            Route::delete('country/delete', [App\Http\Controllers\Admin\CountryController::class, 'delete'])->name('admin.country.delete');
            Route::post('country/activate', [App\Http\Controllers\Admin\CountryController::class, 'activate'])->name('admin.country.activate');

            /************ Regions  **********/
            Route::get('regions/{item}', [App\Http\Controllers\Admin\RegionController::class, 'all'])->name('admin.regions');
            Route::get('region/{item}', [App\Http\Controllers\Admin\RegionController::class, 'edit'])->name('admin.region');
            Route::post('region/store/{item?}', [App\Http\Controllers\Admin\RegionController::class, 'store'])->name('admin.region.store');
            Route::delete('region/delete', [App\Http\Controllers\Admin\RegionController::class, 'delete'])->name('admin.region.delete');
            Route::post('region/activate', [App\Http\Controllers\Admin\RegionController::class, 'activate'])->name('admin.region.activate');

            /************ Cities  **********/
            Route::get('cities/{item}', [App\Http\Controllers\Admin\CityController::class, 'all'])->name('admin.cities');
            Route::get('city/{item}', [App\Http\Controllers\Admin\CityController::class, 'edit'])->name('admin.city');
            Route::post('city/store/{item?}', [App\Http\Controllers\Admin\CityController::class, 'store'])->name('admin.city.store');
            Route::delete('city/delete', [App\Http\Controllers\Admin\CityController::class, 'delete'])->name('admin.city.delete');
            Route::post('city/activate', [App\Http\Controllers\Admin\CityController::class, 'activate'])->name('admin.city.activate');

            /************ Brands  **********/
            Route::get('brand/search', [App\Http\Controllers\Admin\BrandController::class, 'search'])->name('admin.brand.search');
            Route::get('brands', [App\Http\Controllers\Admin\BrandController::class, 'all'])->name('admin.brands');
            Route::get('brand/{item}', [App\Http\Controllers\Admin\BrandController::class, 'edit'])->name('admin.brand');
            Route::post('brand/store/{item?}', [App\Http\Controllers\Admin\BrandController::class, 'store'])->name('admin.brand.store');
            Route::delete('brand/delete', [App\Http\Controllers\Admin\BrandController::class, 'delete'])->name('admin.brand.delete');
            Route::post('brand/activate', [App\Http\Controllers\Admin\BrandController::class, 'activate'])->name('admin.brand.activate');

            /************ Models  **********/
            Route::get('models/{brand}', [App\Http\Controllers\Admin\ModelController::class, 'all'])->name('admin.models');
            Route::get('model/{item}', [App\Http\Controllers\Admin\ModelController::class, 'edit'])->name('admin.model');
            Route::post('model/store/{item?}', [App\Http\Controllers\Admin\ModelController::class, 'store'])->name('admin.model.store');
            Route::delete('model/delete', [App\Http\Controllers\Admin\ModelController::class, 'delete'])->name('admin.model.delete');
            Route::post('model/activate', [App\Http\Controllers\Admin\ModelController::class, 'activate'])->name('admin.model.activate');

            /************* Pieces *******************/
            Route::get('piece/search', [App\Http\Controllers\Admin\PieceController::class, 'search'])->name('admin.piece.search');
            Route::get('pieces', [App\Http\Controllers\Admin\PieceController::class, 'all'])->name('admin.pieces');
            Route::get('piece/{id}', [App\Http\Controllers\Admin\PieceController::class, 'edit'])->name('admin.piece');
            Route::post('piece/store/{item?}', [App\Http\Controllers\Admin\PieceController::class, 'store'])->name('admin.piece.store');
            Route::delete('piece/delete', [App\Http\Controllers\Admin\PieceController::class, 'delete'])->name('admin.piece.delete');

            Route::post('alt/store/{piece}', [App\Http\Controllers\Admin\PieceController::class, 'store_alts'])->name('admin.alt.store');
            Route::delete('alt/delete', [App\Http\Controllers\Admin\PieceController::class, 'delete_alt'])->name('admin.alt.delete');
            Route::post('alt/update/{alt}', [App\Http\Controllers\Admin\PieceController::class, 'update_alt'])->name('admin.alt.update');

            /************ Bad Words  **********/
            Route::get('badwords', [App\Http\Controllers\Admin\BadWordController::class, 'all'])->name('admin.badwords');
            Route::get('badword/{item}', [App\Http\Controllers\Admin\BadWordController::class, 'edit'])->name('admin.badword');
            Route::post('badword/store/{item?}', [App\Http\Controllers\Admin\BadWordController::class, 'store'])->name('admin.badword.store');
            Route::delete('badword/delete', [App\Http\Controllers\Admin\BadWordController::class, 'delete'])->name('admin.badword.delete');


            /************* Contact Us *******************/
            Route::get('contact-us', [App\Http\Controllers\Admin\ContactUsController::class, 'all'])->name('admin.contact_us');
            Route::get('contact-us/{item}', [App\Http\Controllers\Admin\ContactUsController::class, 'show'])->name('admin.contact_us.show');
            Route::delete('contact-us/delete', [App\Http\Controllers\Admin\ContactUsController::class, 'delete'])->name('admin.contact_us.delete');

            /************* Pages *******************/
            Route::get('page/{item}', [App\Http\Controllers\Admin\PageController::class, 'edit'])->name('admin.page');
            Route::post('page/store/{item}', [App\Http\Controllers\Admin\PageController::class, 'store'])->name('admin.page.store');

            /************** Slider ***************************/
            Route::get('sliders', [App\Http\Controllers\Admin\SliderController::class, 'all'])->name('admin.sliders');
            Route::get('slider/{item}', [App\Http\Controllers\Admin\SliderController::class, 'edit'])->name('admin.slider');
            Route::post('slider/store/{item?}', [App\Http\Controllers\Admin\SliderController::class, 'store'])->name('admin.slider.store');
            Route::delete('slider/delete', [App\Http\Controllers\Admin\SliderController::class, 'delete'])->name('admin.slider.delete');
            Route::post('slider/activate', [App\Http\Controllers\Admin\SliderController::class, 'activate'])->name('admin.slider.activate');

            /************* Ads *******************/
            Route::get('ads', [App\Http\Controllers\Admin\AdController::class, 'all'])->name('admin.ads');
            Route::get('ad/{item}', [App\Http\Controllers\Admin\AdController::class, 'edit'])->name('admin.ad');
            Route::post('ad/store/{item?}', [App\Http\Controllers\Admin\AdController::class, 'store'])->name('admin.ad.store');
            Route::delete('ad/delete', [App\Http\Controllers\Admin\AdController::class, 'delete'])->name('admin.ad.delete');
            Route::post('ad/activate', [App\Http\Controllers\Admin\AdController::class, 'activate'])->name('admin.ad.activate');

            /*************** Notifications  **********************/
            Route::get('notifications', [App\Http\Controllers\Admin\NotificationController::class, 'all'])->name('admin.notifications');
            Route::get('notification/{item}', [App\Http\Controllers\Admin\NotificationController::class, 'edit'])->name('admin.notification');
            Route::post('notification/store/{item?}', [App\Http\Controllers\Admin\NotificationController::class, 'store'])->name('admin.notification.store');
            Route::delete('notification/delete', [App\Http\Controllers\Admin\NotificationController::class, 'delete'])->name('admin.notification.delete');

            /************ Coupons  **********/
            Route::get('coupons', [App\Http\Controllers\Admin\CouponController::class, 'all'])->name('admin.coupons');
            Route::get('coupon/{item}', [App\Http\Controllers\Admin\CouponController::class, 'edit'])->name('admin.coupon');
            Route::post('coupon/store/{item?}', [App\Http\Controllers\Admin\CouponController::class, 'store'])->name('admin.coupon.store');
            Route::delete('coupon/delete', [App\Http\Controllers\Admin\CouponController::class, 'delete'])->name('admin.coupon.delete');

            /************ Stock  **********/
            Route::get('stock', [App\Http\Controllers\Admin\StockController::class, 'all'])->name('admin.stocks');
            Route::get('stock/{brand}/{model}/{year}/{piece}', [App\Http\Controllers\Admin\StockController::class, 'show'])->name('admin.stock');
            Route::post('stock/store/{item?}', [App\Http\Controllers\Admin\StockController::class, 'store'])->name('admin.stock.store');
            Route::delete('stock/delete', [App\Http\Controllers\Admin\StockController::class, 'delete'])->name('admin.stock.delete');
            Route::get('stock/search', [App\Http\Controllers\Admin\StockController::class, 'search'])->name('admin.stock.search');

            /************ Cars  **********/
            Route::get('cars/antiques', [App\Http\Controllers\Admin\CarController::class, 'antiques'])->name('admin.antiques');
            Route::get('cars/damaged', [App\Http\Controllers\Admin\CarController::class, 'damaged'])->name('admin.damaged');
            Route::get('car/{id}', [App\Http\Controllers\Admin\CarController::class, 'edit'])->name('admin.car');
            Route::get('car/comments/{car}', [App\Http\Controllers\Admin\CarController::class, 'comments'])->name('admin.car.comments');
            Route::delete('car_comment/delete', [App\Http\Controllers\Admin\CarController::class, 'comment_delete'])->name('admin.car_comment.delete');
            Route::post('car_comment/activate', [App\Http\Controllers\Admin\CarController::class, 'comment_activate'])->name('admin.car_comment.activate');
            Route::post('car/store/{id?}', [App\Http\Controllers\Admin\CarController::class, 'store'])->name('admin.car.store');
            Route::post('car/imgs_store/{id?}', [App\Http\Controllers\Admin\CarController::class, 'imgs_store'])->name('admin.car.imgs_store');

            /************* Car Bidding *******************/

            Route::get('bidding/all', [App\Http\Controllers\Admin\CarBiddingController::class, 'all'])->name('admin.bidding');
            Route::get('bidding/approve/{id}/{status}', [App\Http\Controllers\Admin\CarBiddingController::class, 'updateStatusApprove'])->name('admin.bidding.updateStatusApprove');
            Route::get('bidding/reject/{id}/{status}', [App\Http\Controllers\Admin\CarBiddingController::class, 'updateStatusReject'])->name('admin.bidding.updateStatusReject');
            Route::get('bidding/delete', [App\Http\Controllers\Admin\CarBiddingController::class, 'delete'])->name('admin.bidding.delete');
            Route::get('bidding/update/{id?}', [App\Http\Controllers\Admin\CarBiddingController::class, 'update'])->name('admin.bidding.store');

            /************ Delivery Regions  **********/
            Route::get('delivery_regions', [App\Http\Controllers\Admin\DeliveryRegionController::class, 'all'])->name('admin.delivery_regions');
            Route::get('delivery_region/{item}', [App\Http\Controllers\Admin\DeliveryRegionController::class, 'edit'])->name('admin.delivery_region');
            Route::post('delivery_region/store/{item?}', [App\Http\Controllers\Admin\DeliveryRegionController::class, 'store'])->name('admin.delivery_region.store');
            Route::delete('delivery_region/delete', [App\Http\Controllers\Admin\DeliveryRegionController::class, 'delete'])->name('admin.delivery_region.delete');
            Route::post('delivery_region/activate', [App\Http\Controllers\Admin\DeliveryRegionController::class, 'activate'])->name('admin.delivery_region.activate');

            /************ DB Engine  **********/
            Route::get('db_engine', [App\Http\Controllers\Admin\DBEngineController::class, 'index'])->name('admin.db_engine');
            Route::get('empty_tables', [App\Http\Controllers\Admin\DBEngineController::class, 'empty_tables'])->name('admin.empty_tables');
            Route::get('next_round', [App\Http\Controllers\Admin\DBEngineController::class, 'next_round'])->name('admin.next_round');

            /************ Export PDF Data  ***************************/
            Route::get('export/users/pdf', [App\Http\Controllers\Admin\ExportPdfController::class, 'users'])->name('export.pdf.users');
            Route::get('export/sellers/pdf', [App\Http\Controllers\Admin\ExportPdfController::class, 'sellers'])->name('export.pdf.sellers');
            Route::get('export/supervisors/pdf', [App\Http\Controllers\Admin\ExportPdfController::class, 'supervisors'])->name('export.pdf.supervisors');

            Route::get('export/requests/pdf/normal', [App\Http\Controllers\Admin\ExportPdfController::class, 'requests_normal'])->name('export.pdf.requests.normal');
            Route::get('export/requests/pdf/vip', [App\Http\Controllers\Admin\ExportPdfController::class, 'requests_vip'])->name('export.pdf.requests.vip');
            Route::get('export/requests/pdf/admin', [App\Http\Controllers\Admin\ExportPdfController::class, 'requests_admin'])->name('export.pdf.requests.admin');

            Route::get('export/cars/pdf/{type}', [App\Http\Controllers\Admin\ExportPdfController::class, 'cars']);
            Route::get('export/bidding/pdf', [App\Http\Controllers\Admin\ExportPdfController::class, 'bidding']);

            Route::get('export/stock/pdf', [App\Http\Controllers\Admin\ExportPdfController::class, 'stock']);
            Route::get('export/seller_brands/pdf/{item}', [App\Http\Controllers\Admin\ExportPdfController::class, 'sellers_brands'])->name('export.pdf.sellers_brands');

            /************ Export Excel Data  ***************************/
            Route::get('export/users/excel', [App\Http\Controllers\Admin\ExportExcelController::class, 'users'])->name('export.excel.users');
            Route::get('export/sellers/excel', [App\Http\Controllers\Admin\ExportExcelController::class, 'sellers'])->name('export.excel.sellers');
            Route::get('export/supervisors/excel', [App\Http\Controllers\Admin\ExportExcelController::class, 'supervisors'])->name('export.excel.supervisors');

            Route::get('export/excel/requests/normal', [App\Http\Controllers\Admin\ExportExcelController::class, 'requests_normal'])->name('export.excel.requests.normal');
            Route::get('export/excel/requests/vip', [App\Http\Controllers\Admin\ExportExcelController::class, 'requests_vip'])->name('export.excel.requests.vip');
            Route::get('export/excel/requests/admin', [App\Http\Controllers\Admin\ExportExcelController::class, 'requests_admin'])->name('export.excel.requests.admin');

            Route::get('export/cars/excel/{item}', [App\Http\Controllers\Admin\ExportExcelController::class, 'cars']);
            Route::get('export/bidding/excel', [App\Http\Controllers\Admin\ExportExcelController::class, 'bidding']);

            Route::get('export/stock/excel', [App\Http\Controllers\Admin\ExportExcelController::class, 'stock']);

            /************ Cars  ***************************/
        });
    }
);



//--------- Help APIs ----------
Route::get('clear/session', [App\Http\Controllers\HelpController::class, 'clear_session'])->name('session.clear');
