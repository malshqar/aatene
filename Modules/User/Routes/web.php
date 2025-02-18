<?php

use Modules\User\Http\Controllers\UserController;

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

Route::middleware('auth:admin')->prefix('dashboard')->name('dashboard.')->group(function() {
    // Route::get('/', 'UserController@index');
    Route::get('/users/ban/{user}',[UserController::class,'ban'])->name('users.ban');
    Route::post('/users/blocked/{user}',[UserController::class,'blocked'])->name('users.blocked');
    Route::post('/users/cancel-ban/{user}',[UserController::class,'cancelBan'])->name('users.cancel-ban');
    Route::resource('/users',UserController::class);
});

