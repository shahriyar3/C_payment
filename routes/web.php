<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('artisan-call', function () {
//    \Illuminate\Support\Facades\Artisan::call('migrate:fresh --seed');
//    \Illuminate\Support\Facades\Artisan::call('migrate:fresh');
//    \Illuminate\Support\Facades\Artisan::call('storage:link');
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});

Route::get('payment-form/{token}', [\App\Http\Controllers\PaymentFormController::class, 'showPaymentForm'])->name('show_payment_form');

//kenzo
Route::get('payment/callback', [\App\Http\Controllers\VerifyController::class, 'verify'])->name('verify_payment');

//irgate
Route::get('payment/gateway-callback', [\App\Http\Controllers\VerifyController::class, 'irGateVerify'])->name('ir_gate_verify');

Route::post('payment', [\App\Http\Controllers\StorePaymentController::class, 'store'])->name('store_payment');
Route::get('alert/{text}/{token?}', [\App\Http\Controllers\AlertController::class, 'show'])->name('alert');

Route::get('upc-login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('upc-login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('logout');

Route::prefix('upcadmin')->name('upcadmin.')->middleware('auth')->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('prices/{price}/remove', [\App\Http\Controllers\Admin\PriceController::class, 'remove'])->name('remove');
    Route::resource('prices', \App\Http\Controllers\Admin\PriceController::class)->except(['update', 'show', 'edit']);
    Route::resource('payments', \App\Http\Controllers\Admin\PaymentController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::get('active-payment', [\App\Http\Controllers\Admin\ActivePaymentController::class, 'index'])->name('acive_payment');
    Route::post('active-payment', [\App\Http\Controllers\Admin\ActivePaymentController::class, 'store'])->name('store_active_payment');
});
