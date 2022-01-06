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
    Route::middleware(['auth'])->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');

        Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
        Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
        Route::get('/reservations/nik', [ReservationController::class, 'nik']);
        Route::get('/reservations/reservations', [ReservationController::class, 'reservations']);
        Route::get('/reservations/rooms', [ReservationController::class, 'rooms']);
        Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit']);
        Route::get('/reservations/status/{reservation}/edit', [ReservationController::class, 'editStatus']);
        Route::patch('/reservations/{reservation}', [ReservationController::class, 'update']);
        Route::patch('/reservations/status/{reservation}', [ReservationController::class, 'updateStatus']);
        Route::post('/reservations', [ReservationController::class, 'store']);
        Route::post('/reservations/room/{reservation}', [ReservationController::class, 'storeRoom']);
        Route::post('/reservations/service/{reservation}', [ReservationController::class, 'storeService']);
        Route::post('/reservations/restaurant/{reservation}', [ReservationController::class, 'storeRestaurant']);
        Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy']);

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/users', [UserController::class, 'users']);
        Route::get('/users/{user}/edit', [UserController::class, 'edit']);
        Route::post('/users', [UserController::class, 'store']);
        Route::patch('/users/{user}', [UserController::class, 'update']);
        Route::delete('/users/{user}', [UserController::class, 'destroy']);

        Route::get('/room-types', [RoomTypeController::class, 'index'])->name('room-types.index');
        Route::get('/room-types/room-types', [RoomTypeController::class, 'roomTypes']);
        Route::get('/room-types/facilities', [RoomTypeController::class, 'facilities']);
        Route::get('/room-types/{roomType}/edit', [RoomTypeController::class, 'edit']);
        Route::post('/room-types', [RoomTypeController::class, 'store']);
        Route::patch('/room-types/{roomType}', [RoomTypeController::class, 'update']);
        Route::delete('/room-types/{roomType}', [RoomTypeController::class, 'destroy']);

        Route::get('/facilities', [FacilityController::class, 'index'])->name('facilities.index');
        Route::get('/facilities/facilities', [FacilityController::class, 'facilities']);
        Route::get('/facilities/{facility}/edit', [FacilityController::class, 'edit']);
        Route::post('/facilities', [FacilityController::class, 'store']);
        Route::patch('/facilities/{facility}', [FacilityController::class, 'update']);
        Route::delete('/facilities/{facility}', [FacilityController::class, 'destroy']);

        Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
        Route::get('/rooms/rooms', [RoomController::class, 'rooms']);
        Route::get('/rooms/room-types', [RoomController::class, 'roomTypes']);
        Route::get('/rooms/{room}/edit', [RoomController::class, 'edit']);
        Route::post('/rooms', [RoomController::class, 'store']);
        Route::patch('/rooms/{room}', [RoomController::class, 'update']);
        Route::delete('/rooms/{room}', [RoomController::class, 'destroy']);

        Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
        Route::get('/restaurants/restaurants', [RestaurantController::class, 'restaurants']);
        Route::get('/restaurants/{restaurant}/edit', [RestaurantController::class, 'edit']);
        Route::post('/restaurants', [RestaurantController::class, 'store']);
        Route::patch('/restaurants/{restaurant}', [RestaurantController::class, 'update']);
        Route::delete('/restaurants/{restaurant}', [RestaurantController::class, 'destroy']);

        Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
        Route::get('/services/services', [ServiceController::class, 'services']);
        Route::get('/services/{service}/edit', [ServiceController::class, 'edit']);
        Route::post('/services', [ServiceController::class, 'store']);
        Route::patch('/services/{service}', [ServiceController::class, 'update']);
        Route::delete('/services/{service}', [ServiceController::class, 'destroy']);

        Route::get('/guests', [GuestController::class, 'index'])->name('guests.index');
        Route::get('/guests/guests', [GuestController::class, 'guests']);
        Route::get('/guests/{guest}', [GuestController::class, 'show']);
        Route::get('/guests/{guest}/edit', [GuestController::class, 'edit']);
        Route::post('/guests', [GuestController::class, 'store']);
        Route::patch('/guests/{guest}', [GuestController::class, 'update']);
        Route::delete('/guests/{guest}', [GuestController::class, 'destroy']);
    });
});

require __DIR__ . '/auth.php';
