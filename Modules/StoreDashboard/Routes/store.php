<?php

use Modules\StoreDashboard\Http\Controllers\StoreDashboardController;

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

Route::middleware(['has_store'])->group(function() {
    Route::get('/', [StoreDashboardController::class,'index']);
});
