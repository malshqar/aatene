<?php

use Illuminate\Http\Request;
use Modules\Store\Http\Controllers\StoreApiController;

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

// Route::middleware('auth:api')->get('/store', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:seller_api')->post('/store/create', [StoreApiController::class, 'store']);