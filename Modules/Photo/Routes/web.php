<?php

use Modules\Photo\Http\Controllers\ImageUploadController;

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
Route::post('image-upload', [ImageUploadController::class, 'storeImage'])->name('image.upload');
Route::delete('/delete-image', [ImageUploadController::class, 'deleteImage'])->name('image.delete');
