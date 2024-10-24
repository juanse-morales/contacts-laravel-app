<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactPhotoController;
use App\Http\Controllers\ContactFileController;

Route::group(['prefix' => 'contact'], function() {
  Route::get('index/{filter}', [ContactController::class, 'index']);
  Route::get('archived/{filter}', [ContactController::class, 'getArchived']);
  Route::get('blocked/{filter}', [ContactController::class, 'getBlocked']);
  Route::get('deleted/{filter}', [ContactController::class, 'getDeleted']);
  Route::get('{id}', [ContactController::class, 'show']);
  Route::post('', [ContactController::class, 'store']);
  Route::put('/{id}', [ContactController::class, 'update']);
  Route::delete('/{id}', [ContactController::class, 'destroy']);
  Route::put('/restore/{id}', [ContactController::class, 'restore']);
  Route::put('/block/{id}', [ContactController::class, 'block']);
  Route::put('/archive/{id}', [ContactController::class, 'archive']);
});

Route::group(['prefix' => 'photo'], function() {
  Route::post('upload/{id}', [ContactPhotoController::class, 'upload_photo']);
  Route::get('view/{filename}', [ContactPhotoController::class, 'view_photo']);
  Route::get('getfilename/{id}', [ContactPhotoController::class, 'get_filename']);
  Route::get('index/{contactid}', [ContactPhotoController::class, 'index_by_contact']);
});

Route::group(['prefix' => 'file'], function() {
  Route::post('upload/{id}', [ContactFileController::class, 'upload_file']);
  Route::get('view/{filename}', [ContactFileController::class, 'view_file']);
  Route::get('getfilename/{id}', [ContactFileController::class, 'get_filename']);
  Route::get('getoriginalfilename/{id}', [ContactFileController::class, 'get_original_filename']);
  Route::get('index/{contactid}', [ContactFileController::class, 'index_by_contact']);
});