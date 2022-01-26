<?php

use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\PolicyController;
use App\Http\Controllers\Guest\PrivacyController;
use App\Http\Controllers\Guest\RoomBookingController;
use App\Http\Controllers\Guest\RoomDetailController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::resource('/room-details', RoomDetailController::class);
Route::resource('/room-booking', RoomBookingController::class);
Route::resource('/policies', PolicyController::class);
Route::resource('/privacies', PrivacyController::class);
