<?php

use Illuminate\Http\Request;
use Modules\Seller\Http\Controllers\SellerApiController;
use Modules\Seller\Http\Controllers\SellerController;

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

Route::middleware('auth:api')->get('/seller', function (Request $request) {
    return $request->user();
});
Route::post('/seller/store',[SellerApiController::class,'store']);