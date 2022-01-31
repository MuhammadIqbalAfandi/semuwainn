<?php

use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\PolicyController;
use App\Http\Controllers\Guest\PrivacyController;
use App\Http\Controllers\Guest\RoomBookingController;
use App\Http\Controllers\Guest\RoomDetailController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);
Route::resource('/room-details', RoomDetailController::class)
    ->only('show');
Route::resource('/room-booking', RoomBookingController::class)
    ->only('index', 'store');
Route::get('/policies', PolicyController::class)
    ->name('policies');
Route::get('/privacies', PrivacyController::class)
    ->name('privacies');
