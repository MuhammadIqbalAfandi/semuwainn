<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\FacilityController;
use App\Http\Controllers\Dashboard\GuestController;
use App\Http\Controllers\Dashboard\ReservationController;
use App\Http\Controllers\Dashboard\RestaurantController;
use App\Http\Controllers\Dashboard\RoomController;
use App\Http\Controllers\Dashboard\RoomTypeController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\RoomBookingController;
use App\Http\Controllers\Guest\RoomDetailController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::resource('room-details', RoomDetailController::class);
Route::resource('room-booking', RoomBookingController::class);

Route::prefix('dashboard')->group(function () {
    Route::name('dashboard.')->group(function () {
        Route::middleware(['auth'])->group(function () {
            Route::get('/', DashboardController::class)->name('dashboard');

            Route::get('/reservations/nik', [ReservationController::class, 'nik']);
            Route::get('/reservations/reservations', [ReservationController::class, 'reservations']);
            Route::get('/reservations/rooms', [ReservationController::class, 'rooms']);
            Route::get('/reservations/status/{reservation}/edit', [ReservationController::class, 'editStatus']);
            Route::patch('/reservations/status/{reservation}', [ReservationController::class, 'updateStatus']);
            Route::post('/reservations', [ReservationController::class, 'store']);
            Route::post('/reservations/room/{reservation}', [ReservationController::class, 'storeRoom']);
            Route::post('/reservations/service/{reservation}', [ReservationController::class, 'storeService']);
            Route::post('/reservations/restaurant/{reservation}', [ReservationController::class, 'storeRestaurant']);
            Route::resource('/reservations', ReservationController::class);

            Route::get('/users/users', [UserController::class, 'users']);
            Route::resource('/users', UserController::class);

            Route::get('/room-types/room-types', [RoomTypeController::class, 'roomTypes']);
            Route::get('/room-types/facilities', [RoomTypeController::class, 'facilities']);
            Route::resource('/room-types', RoomTypeController::class);

            Route::get('/facilities/facilities', [FacilityController::class, 'facilities']);
            Route::resource('/facilities', FacilityController::class);

            Route::get('/rooms/rooms', [RoomController::class, 'rooms']);
            Route::get('/rooms/room-types', [RoomController::class, 'roomTypes']);
            Route::resource('/rooms', RoomController::class);

            Route::get('/restaurants/restaurants', [RestaurantController::class, 'restaurants']);
            Route::resource('/restaurants', RestaurantController::class);

            Route::get('/services/services', [ServiceController::class, 'services']);
            Route::resource('/services', ServiceController::class);

            Route::get('/guests/guests', [GuestController::class, 'guests']);
            Route::resource('/guests', GuestController::class);
        });
    });
});

require __DIR__ . '/auth.php';
