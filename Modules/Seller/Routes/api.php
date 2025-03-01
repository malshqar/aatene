<?php

use Modules\Seller\Http\Controllers\SellerApiController;



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

Route::get('/sellers', [SellerApiController::class, 'index']);
Route::middleware('auth:seller_api')->get('/seller/profile', [SellerApiController::class, 'profile']);
Route::middleware('auth:seller_api')->delete('/seller/remove-account', [SellerApiController::class, 'destroy']);