<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/contact', [ContactController::class, 'index']);

Route::get('/contact/{id}', [ContactController::class, 'show']);

Route::post('/contact', [ContactController::class, 'store']);

Route::put('/contact/{id}', [ContactController::class, 'update']);

Route::delete('/contact/{id}', [ContactController::class, 'destroy']);
