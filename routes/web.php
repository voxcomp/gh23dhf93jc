<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('front');
Route::get('unauthorized', [HomeController::class, 'unauthorized'])->name('unauthorized');
// Route::get('test', 'HomeController@test')->name('test');

Route::get('event-register', [HomeController::class, 'index'])->name('event.register');
Route::get('ec60a1ecc8474169d09fbe0a6fc0d1fb', [HomeController::class, 'register'])->name('event.register.private');
Route::get(md5(date('Y')), [HomeController::class, 'register'])->name('event.register.private');
Route::post('event-register', [HomeController::class, 'registerStep1'])->name('event.register.step1');
Route::patch('event-register', [HomeController::class, 'registerStepOptions'])->name('event.register.options');
Route::post('event-register/pay', [HomeController::class, 'registerPay'])->name('event.register.pay');
Route::get('event-register/pay', [HomeController::class, 'registerPay'])->name('event.register.pay.get');
Route::post('event-register/submit', [HomeController::class, 'registerSubmit'])->name('event.register.submit');
Route::get('event-register/{invoice}', [HomeController::class, 'registerSuccess'])->name('event.register.success');
Route::get('wristband', [HomeController::class, 'registerWristband'])->name('event.register.wristband');
Route::post('wristband', [HomeController::class, 'registerSaveWristband']);

Route::get('payment-request', [AdminController::class, 'paymentRequest'])->name('payment.request');
Route::post('payment-request/send', [AdminController::class, 'sendPaymentRequest'])->name('payment.request.send');
Route::get('payment-request/{invoice}', [HomeController::class, 'paymentRequest'])->name('payment.form');
Route::post('payment', [HomeController::class, 'payment'])->name('payment.pay');

Route::get('cancel', [HomeController::class, 'paymentCancel'])->name('payment.cancel');
Route::get('payment/success', [HomeController::class, 'index'])->name('payment.success');

Route::post('data/search/email/{email}', [DataController::class, 'searchEmail'])->name('search.email');

// ADMIN Routes

Route::get('admin', [AdminController::class, 'index'])->name('admin');
Route::post('admin', [AdminController::class, 'saveOptions'])->name('admin.options');
Route::post('admin/status', [AdminController::class, 'changeStatus'])->name('admin.status');
Route::get('admin/download', [AdminController::class, 'downloadData'])->name('admin.download');
Route::get('admin/download/last', [AdminController::class, 'downloadDataLast'])->name('admin.download.last');
Route::get('home', [AdminController::class, 'index']);

Route::get('test', [HomeController::class, 'test']);
