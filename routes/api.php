<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('payment/tracking', [\App\Http\Controllers\TrackingController::class, 'track'])->name('track');
Route::get('payment', [\App\Http\Controllers\PaymentController::class, 'getToken'])->name('get_token');

//irgate
Route::post('gateway-tracking', [\App\Http\Controllers\VerifyController::class, 'gatewayTracking'])->name('gateway-tracking');
