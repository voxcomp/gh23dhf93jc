<?php

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('front');
Route::get('unauthorized', 'HomeController@unauthorized')->name('unauthorized');
// Route::get('test', 'HomeController@test')->name('test');

Route::get('event-register', 'HomeController@index')->name('event.register');
Route::get('ec60a1ecc8474169d09fbe0a6fc0d1fb', 'HomeController@register')->name('event.register.private');
Route::get(md5(date('Y')), 'HomeController@register')->name('event.register.private');
Route::post('event-register', 'HomeController@registerStep1')->name('event.register.step1');
Route::patch('event-register', 'HomeController@registerStepOptions')->name('event.register.options');
Route::post('event-register/pay', 'HomeController@registerPay')->name('event.register.pay');
Route::get('event-register/pay', 'HomeController@registerPay')->name('event.register.pay.get');
Route::post('event-register/submit', 'HomeController@registerSubmit')->name('event.register.submit');
Route::get('event-register/{invoice}', 'HomeController@registerSuccess')->name('event.register.success');
Route::get('wristband', 'HomeController@registerWristband')->name('event.register.wristband');
Route::post('wristband', 'HomeController@registerSaveWristband');

Route::get('payment-request', 'AdminController@paymentRequest')->name('payment.request');
Route::post('payment-request/send', 'AdminController@sendPaymentRequest')->name('payment.request.send');
Route::get('payment-request/{invoice}', 'HomeController@paymentRequest')->name('payment.form');
Route::post('payment', 'HomeController@payment')->name('payment.pay');

Route::get('cancel', 'HomeController@paymentCancel')->name('payment.cancel');
Route::get('payment/success', 'HomeController@index')->name('payment.success');

Route::post('data/search/email/{email}', 'DataController@searchEmail')->name('search.email');

// ADMIN Routes

Route::get('admin', 'AdminController@index')->name('admin');
Route::post('admin', 'AdminController@saveOptions')->name('admin.options');
Route::post('admin/status', 'AdminController@changeStatus')->name('admin.status');
Route::get('admin/download', 'AdminController@downloadData')->name('admin.download');
Route::get('admin/download/last', 'AdminController@downloadDataLast')->name('admin.download.last');
Route::get('home', 'AdminController@index');

Route::get('test','HomeController@test');
