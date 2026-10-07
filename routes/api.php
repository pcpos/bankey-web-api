<?php
use App\Http\Controllers\Api\V1\AccountController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\BillPaymentController;
use App\Http\Controllers\Api\V1\DeviceController;
use App\Http\Controllers\Api\V1\RecoveryController;
use App\Http\Controllers\Api\V1\TransferController;
use Illuminate\Support\Facades\Route;
Route::prefix('v1')->group(function (): void {
 Route::post('/auth/login',[AuthController::class,'login']);
 Route::get('/accounts',[AccountController::class,'index']);
 Route::get('/accounts/{account}/mini-statement',[AccountController::class,'miniStatement']);
 Route::get('/accounts/{account}/statement',[AccountController::class,'statement']);
 Route::post('/transfers/own',[TransferController::class,'own']);
 Route::post('/transfers/other',[TransferController::class,'other']);
 Route::post('/transfers/p2p',[TransferController::class,'p2p']);
 Route::post('/transfers/confirm',[TransferController::class,'confirm']);
 Route::get('/billers',[BillPaymentController::class,'billers']);
 Route::post('/bills/inquiry',[BillPaymentController::class,'inquiry']);
 Route::post('/bills/pay',[BillPaymentController::class,'pay']);
 Route::post('/password/forgot',[RecoveryController::class,'forgot']);
 Route::post('/password/verify-otp',[RecoveryController::class,'verifyOtp']);
 Route::post('/password/reset',[RecoveryController::class,'reset']);
 Route::post('/device/reset',[DeviceController::class,'reset']);
 Route::post('/device/reset/verify',[DeviceController::class,'verify']);
});
