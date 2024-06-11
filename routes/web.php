<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Welcome\WelcomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Main\MainController;
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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/about', [MainController::class, 'about']);
Route::get('/parties', [MainController::class, 'parties']);
Route::get('/brands', [MainController::class, 'brands']);
Route::get('/hunters', [MainController::class, 'hunters']);
Route::get('/faqs', [MainController::class, 'faqs']);

Route::get('/privacy', [MainController::class, 'privacy']);
Route::get('/term', [MainController::class, 'term']);
Route::get('/contact', [MainController::class, 'contact']);
Route::get('push-notification', [NotificationController::class, 'index']);
Route::post('sendNotification', [NotificationController::class, 'sendNotification'])->name('notification');
Route::get('notifications',      [NotificationController::class, 'notifications']);

Route::post('/store-token', [NotificationController::class, 'storeToken'])->name('store.token');
