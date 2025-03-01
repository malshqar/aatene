<?php

use Illuminate\Http\Request;
use Modules\Ads\Http\Controllers\AdsApiController;

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

Route::get('/ads',[AdsApiController::class,'index']);