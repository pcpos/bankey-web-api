<?php
use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Support\Facades\Route;
Route::prefix('v1')->group(function (): void {
 Route::post('/auth/login',[AuthController::class,'login']);
});
