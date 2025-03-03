<?php

use Modules\Store\Http\Controllers\GroupController;
use Modules\Store\Http\Controllers\StoreController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::group(['name'=>''],function (){
//     Route::get('/',function (){

//     });
// });
Route::resource('stores',StoreController::class);
Route::resource('groups',GroupController::class);
Route::post('store-add-to-groups/{store}',[StoreController::class,'addStoreToGroups'])->name('groups.addStoreToGroups');
Route::post('stores/accept/{store}',[StoreController::class,'acceptStore'])->name('stores.accept');
Route::get('stores/actions/{store}',[StoreController::class,'actions'])->name('stores.actions');