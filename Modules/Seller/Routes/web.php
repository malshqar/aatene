<?php

use Modules\Seller\Http\Controllers\SellerController;

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

Route::get('/sellers/ban/{seller}', [SellerController::class, 'ban'])->name('sellers.ban');
Route::post('/sellers/blocked/{seller}', [SellerController::class, 'blocked'])->name('sellers.blocked');
Route::post('/sellers/cancel-ban/{seller}', [SellerController::class, 'cancelBan'])->name('sellers.cancel-ban');
Route::resource('/sellers', SellerController::class);

