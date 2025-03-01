<?php

use Illuminate\Http\Request;
use Modules\Auth\Http\Controllers\AuthApiController;

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

// Route::middleware('auth:api')->get('/auth', function (Request $request) {
//     return $request->user();
// });
// // Route::post('/login);


Route::post('/user/login', [AuthApiController::class, 'loginUser']);
Route::post('/seller/login', [AuthApiController::class, 'loginSeller']);
Route::middleware('auth:seller_api,user_api')->post('/logout', [AuthApiController::class, 'logout']);

Route::post('/seller/register',[AuthApiController::class,'registerSeller']);
Route::post('/user/register',[AuthApiController::class,'registerUser']);
Route::get( '/email/verify/{id}/{hash}',[AuthApiController::class,'verify'])
->middleware(['throttle:6'])
->name('verification.verify');