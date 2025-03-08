<?php

use Modules\HubConnect\Http\Controllers\BlogController;
use Modules\HubConnect\Http\Controllers\FaqCategoryController;
use Modules\HubConnect\Http\Controllers\FaqsController;
use Modules\HubConnect\Http\Controllers\JobAdsController;
use Modules\HubConnect\Http\Controllers\TopicController;

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

Route::resource('/blogs', BlogController::class);
Route::resource('faqs_categories', FaqCategoryController::class);
Route::resource('faqs', FaqsController::class)->except('show');
Route::resource('job-ads', JobAdsController::class);
Route::resource('topics', TopicController::class);

Route::post('blogs/publish/{blog}', [BlogController::class, 'publish'])->name('blogs.publish');
