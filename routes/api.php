<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FinanceController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::prefix('auth')->group(function () {
    Route::post('signup', [AuthController::class,'signup'])->name('auth.signup');
    Route::post('login', [AuthController::class,'login'])->name('auth.login');
    Route::post('logout', [AuthController::class,'logout'])->middleware('auth:sanctum')->name('auth.logout');
    Route::get('user', [AuthController::class,'getAuthenticatedUser'])->middleware('auth:sanctum')->name('auth.user');

    Route::post('/password/email', [AuthController::class,'sendPasswordResetLinkEmail'])->middleware('throttle:5,1')->name('password.email');
    Route::post('/password/reset', [AuthController::class,'resetPassword'])->name('password.reset');
});
Route::prefix('finance')->middleware('auth:sanctum')->group(function () {
    Route::get('previous-data', [FinanceController::class,'getPreviousData'])->name('fin.previous');
    Route::post('/store', [FinanceController::class,'calculateHealthScore'])->name('fin.health_score');
});

