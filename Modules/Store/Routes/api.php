<?php

use Illuminate\Http\Request;
use Modules\Store\Http\Controllers\GroupApiController;
use Modules\Store\Http\Controllers\StoreApiController;
use Modules\Store\Http\Controllers\StoryApiController;
use Modules\Store\Http\Controllers\UserStroyController;

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
Route::get('/stores', [StoreApiController::class, 'index']);
Route::get('/store/{store:slug}', [StoreApiController::class, 'show']);
Route::get('/stores-with-seller', [StoreApiController::class, 'storeWithSeller']);
Route::middleware('auth:seller_api')->delete('/store/delete',[StoreApiController::class,'destroy']);

Route::middleware('auth:seller_api')->group(function (){
    Route::apiResource('/stories', StoryApiController::class);
});

Route::middleware('auth:user_api')->group(function (){
    Route::get('followers/stories', [UserStroyController::class,'index']);
    Route::get('/story/{id}', [UserStroyController::class,'viewStory']);
    Route::post('/story/reactions/{story}', [UserStroyController::class,'reactions']);
    Route::post('/story/remove-reaction/{story}', [UserStroyController::class,'removeReaction']);
});




Route::get('groups', [GroupApiController::class, 'index']);
Route::get('group/{group}', [GroupApiController::class, 'show']);
    
