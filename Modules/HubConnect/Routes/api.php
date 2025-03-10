<?php

use Illuminate\Http\Request;
use Modules\HubConnect\Http\Controllers\Api\BlogController;
use Modules\HubConnect\Http\Controllers\Api\TopicController;

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

Route::get('topics/me',[TopicController::class,'me']);
Route::get('blogs',[BlogController::class,'index']);
Route::apiResource('topics',TopicController::class);