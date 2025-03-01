<?php

use Illuminate\Http\Request;
use Modules\User\Http\Controllers\UserApiController;

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

// Route::get('/users', function (Request $request) {
// });
Route::get('/users',[UserApiController::class,'index']);
Route::middleware('auth:user_api')->get('/user/profile', [UserApiController::class, 'profile']);
Route::middleware('auth:user_api')->delete('/user/remove-account', [UserApiController::class, 'destroy']);
Route::get('/user/{user}',[UserApiController::class,'show']);