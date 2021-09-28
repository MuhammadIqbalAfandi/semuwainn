<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\RoomBookingController;
use App\Http\Controllers\Guest\RoomDetailController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('/', HomeController::class);
Route::resource('room-detail', RoomDetailController::class);
Route::resource('room-booking', RoomBookingController::class);

Route::prefix('dashboard')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');

        Route::get('/facility', [FacilityController::class, 'index'])->name('facility.index');
        Route::get('/facility/facilities', [FacilityController::class, 'facilities']);
        Route::get('/facility/{facility}/edit', [FacilityController::class, 'edit']);
        Route::post('/facility', [FacilityController::class, 'store']);
        Route::patch('/facility/{facility}', [FacilityController::class, 'update']);
        Route::delete('/facility/{facility}', [FacilityController::class, 'destroy']);

        Route::get('/room-type', [RoomTypeController::class, 'index'])->name('room-type.index');
        Route::get('/room-type/room-types', [RoomTypeController::class, 'roomTypes']);
        Route::get('/room-type/{roomType}/edit', [RoomTypeController::class, 'edit']);
        Route::post('/room-type', [RoomTypeController::class, 'store']);
        Route::patch('/room-type/{roomType}', [RoomTypeController::class, 'update']);
        Route::delete('/room-type/{roomType}', [RoomTypeController::class, 'destroy']);

        Route::get('/room', [RoomController::class, 'index'])->name('room.index');
        Route::get('/room/rooms', [RoomController::class, 'rooms']);
        Route::get('/room/{room}/edit', [RoomController::class, 'edit']);
        Route::post('/room', [RoomController::class, 'store']);
        Route::patch('/room/{room}', [RoomController::class, 'update']);
        Route::delete('/room/{room}', [RoomController::class, 'destroy']);

        Route::get('/restaurant', [RestaurantController::class, 'index'])->name('restaurant.index');
        Route::get('/restaurant/restaurants', [RestaurantController::class, 'restaurants']);
        Route::get('/restaurant/{restaurant}/edit', [RestaurantController::class, 'edit']);
        Route::post('/restaurant', [RestaurantController::class, 'store']);
        Route::patch('/restaurant/{restaurant}', [RestaurantController::class, 'update']);
        Route::delete('/restaurant/{restaurant}', [RestaurantController::class, 'destroy']);

        Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
        Route::get('/service/services', [ServiceController::class, 'services']);
        Route::get('/service/{service}/edit', [ServiceController::class, 'edit']);
        Route::post('/service', [ServiceController::class, 'store']);
        Route::patch('/service/{service}', [ServiceController::class, 'update']);
        Route::delete('/service/{service}', [ServiceController::class, 'destroy']);

        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/users', [UserController::class, 'users']);
        Route::get('/user/{user}/edit', [UserController::class, 'edit']);
        Route::post('/user', [UserController::class, 'store']);
        Route::patch('/user/{user}', [UserController::class, 'update']);
        Route::delete('/user/{user}', [UserController::class, 'destroy']);

        Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation.index');
        Route::get('/reservation/create', [ReservationController::class, 'create'])->name('reservation.create');
        Route::get('/reservation/nik', [ReservationController::class, 'nik']);
        Route::get('/reservation/reservations', [ReservationController::class, 'reservations']);
        Route::get('/reservation/rooms', [ReservationController::class, 'rooms']);
        Route::get('/reservation/{reservation}/edit', [ReservationController::class, 'edit']);
        Route::get('/reservation/status/{reservation}/edit', [ReservationController::class, 'editStatus']);
        Route::patch('/reservation/{reservation}', [ReservationController::class, 'update']);
        Route::patch('/reservation/status/{reservation}', [ReservationController::class, 'updateStatus']);
        Route::post('/reservation', [ReservationController::class, 'store']);
        Route::post('/reservation/room/{reservation}', [ReservationController::class, 'storeRoom']);
        Route::post('/reservation/service/{reservation}', [ReservationController::class, 'storeService']);
        Route::post('/reservation/restaurant/{reservation}', [ReservationController::class, 'storeRestaurant']);
        Route::delete('/reservation/{reservation}', [ReservationController::class, 'destroy']);

        Route::get('/guest', [GuestController::class, 'index'])->name('guest.index');
        Route::get('/guest/guests', [GuestController::class, 'guests']);
        Route::get('/guest/{guest}', [GuestController::class, 'show']);
        Route::get('/guest/{guest}/edit', [GuestController::class, 'edit']);
        Route::post('/guest', [GuestController::class, 'store']);
        Route::patch('/guest/{guest}', [GuestController::class, 'update']);
        Route::delete('/guest/{guest}', [GuestController::class, 'destroy']);
    });
});

require __DIR__ . '/auth.php';
