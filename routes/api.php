<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Products\ProductsController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Tags\TagsController;
use App\Http\Controllers\Realty\RealtyController;
use App\Http\Controllers\Events\EventsController;
use App\Http\Controllers\City\CityController;
use App\Http\Controllers\Slides\SlidesController;
use App\Http\Controllers\Wallet\WalletController;
use App\Http\Controllers\Card\CardController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\Dashboard\DashboardController;
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
Route::group([
    'middleware' => 'api'
], function ($router) {

    Route::group(['prefix' => 'v1'], function() {
        Route::post('register', [AuthController::class, 'registerMobile']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('reSendCode', [AuthController::class, 'reSend']);
        Route::post('changePassword', [AuthController::class, 'changePassword']);
        Route::post('login_check', [AuthController::class, 'loginCheck']);
        Route::post('login_update_location', [AuthController::class, 'loginUpdateLocation']);
        Route::get('topHunters', [AuthController::class, 'topHunters']);
        Route::get('popularHunters', [AuthController::class, 'popularHunters']);
        Route::post('updateUserInfo', [AuthController::class, 'updateUserInfo']);
        Route::get('infoHunters', [AuthController::class, 'me']);
        Route::get('infoHunters/{id}', [AuthController::class, 'infoHunters']);
        Route::post('editAccount', [AuthController::class, 'update']);
        Route::post('updateFcmUserToken', [AuthController::class, 'updateFmcUserToken']);
        
        Route::get('city/view/all', [CityController::class, 'indexAll']);
     
        Route::get('tag/view/all', [TagsController::class, 'indexAll']);
        Route::get('category/view/all', [CategoryController::class, 'indexAll']);
        Route::get('slide/view/all', [SlidesController::class, 'indexAll']);


        Route::resource('brand', RealtyController::class);
        Route::get('topBrand', [RealtyController::class, 'topBrand']);
        Route::get('brandSponsors',     [RealtyController::class, 'brandSponsors']);
        Route::post('addBrand', [RealtyController::class, 'addBrand']);
        Route::get('myBrand', [RealtyController::class, 'myBrand']);
        Route::get('brand/view/search', [RealtyController::class, 'search']);
        Route::post('editBrand/{id}',  [RealtyController::class, 'editBrand']);


        Route::resource('event', EventsController::class);
        Route::get('event/view/all', [EventsController::class, 'indexAll']);
        Route::get('eventAllOneRequest', [EventsController::class, 'EventAllOneRequest']);
        Route::post('addEvent', [EventsController::class, 'addEvent']);
        Route::get('myEvent', [EventsController::class, 'myEvent']);
        Route::get('myTicket', [EventsController::class, 'myTicket']);
        Route::get('eventTicket/{id}', [EventsController::class, 'eventTicket']);
        Route::get('event/view/search', [EventsController::class, 'search']);
        Route::post('editEvent/{id}',[ EventsController::class,'editEvent']);


         Route::get('follow', [AuthController::class, 'follow']);
         Route::get('unfollow', [AuthController::class, 'unfollow']);

         Route::get('addWishlistsEvent',     [AuthController::class, 'addWishlistsEvent']);
         Route::get('removeWishlistsEvent',  [AuthController::class, 'removeWishlistsEvent']);

     


         Route::get('infoWallet',  [WalletController::class, 'infoWallet']);
         

         Route::post('chargeCard',  [CardController::class, 'chargeCard']);

         Route::post('bookingEvent',  [EventsController::class, 'bookingEvent']);

         Route::get('acceptTicket/{id}',  [EventsController::class, 'acceptTicket']);
         Route::get('rejectTicket/{id}',  [EventsController::class, 'rejectTicket']);


         Route::get('info',  [DashboardController::class, 'info']);

         Route::get('notification',  [AuthController::class, 'notification']);

         /************** new */

         Route::get('listHomeRealty',  [RealtyController::class, 'listHomeRealty']);

         Route::get('addWishlistsRealty',     [AuthController::class, 'addWishlistsRealty']);
         Route::get('removeWishlistRealty',  [AuthController::class, 'removeWishlistRealty']);
         Route::post('updateLocation', [AuthController::class, 'updateLocation']);

         Route::get('property',  [RealtyController::class, 'property']);

         Route::get('city',  [RealtyController::class, 'city']);

         Route::get('governorate',  [RealtyController::class, 'governorate']);

         Route::get('compound',  [RealtyController::class, 'compound']);

         Route::get('compoundRealty',  [RealtyController::class, 'compoundRealty']);

         Route::get('wishlistsRealty',  [RealtyController::class, 'wishlistsRealty']);

         Route::get('myRealty',  [RealtyController::class, 'myRealty']); 

         Route::get('propertyType',  [RealtyController::class, 'propertyType']);

         Route::post('updateRealty/{id}',  [RealtyController::class, 'update']);

         Route::post('delRealtyImage',  [RealtyController::class, 'delRealtyImage']); 


         Route::post('realty',  [RealtyController::class, 'store']); 

         Route::post('realtyFilter', [RealtyController::class, 'search']);

         Route::get('infoAccount', [AuthController::class, 'me']);

         Route::post('feedback', [AuthController::class, 'feedback']);


         Route::get('adsHome',  [RealtyController::class, 'adsHome']);

         Route::get('adsPages',  [RealtyController::class, 'adsPages']);

         Route::get('office',  [RealtyController::class, 'office']);


    });
    
    /**
     * Authentication Module
     */
    Route::group(['prefix' => 'auth'], function() {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });


    /**
     * Products Module
     */


   

    Route::get('dashboardAllInOneRequest', [DashboardController::class, 'dashboardAllInOneRequest']);

    Route::post('notification', [NotificationController::class, 'notification']);

    Route::post('sendNotification', [NotificationController::class, 'sendNotification']);
    

});

