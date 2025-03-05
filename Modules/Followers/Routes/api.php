<?php

use Illuminate\Http\Request;
use Modules\Followers\Http\Controllers\FollowersController;

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

Route::middleware('auth:seller_api,user_api')->get('followers', [FollowersController::class, 'followersList']);
Route::middleware('auth:user_api')->post('follow/{store:slug}', [FollowersController::class, 'follow'])->name('store.follow');
Route::middleware('auth:user_api')->delete('unfollow/{store:slug}', [FollowersController::class, 'unfollow'])->name('store.unfollow');
