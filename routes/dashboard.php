<?php

use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\CopyrightController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\FacilityController;
use App\Http\Controllers\Dashboard\GenderController;
use App\Http\Controllers\Dashboard\GuestController;
use App\Http\Controllers\Dashboard\PolicyController;
use App\Http\Controllers\Dashboard\PrivacyController;
use App\Http\Controllers\Dashboard\ReservationController;
use App\Http\Controllers\Dashboard\ReservationPdfController;
use App\Http\Controllers\Dashboard\ReservationReportController;
use App\Http\Controllers\Dashboard\ReservationStatusController;
use App\Http\Controllers\Dashboard\RestaurantController;
use App\Http\Controllers\Dashboard\RestaurantOrderController;
use App\Http\Controllers\Dashboard\RestaurantReportController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\RoomController;
use App\Http\Controllers\Dashboard\RoomTypeController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\Dashboard\ServiceOrderController;
use App\Http\Controllers\Dashboard\ServiceReportController;
use App\Http\Controllers\Dashboard\ServiceUnitController;
use App\Http\Controllers\Dashboard\ThumbnailController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->group(function () {
    Route::name('dashboard.')->group(function () {
        Route::middleware(['auth', 'verified', 'checkBlocked'])->group(function () {
            Route::get('/charts', [DashboardController::class, 'chartData']);
            Route::get('/', DashboardController::class)
                ->name('dashboard');

            // Reservation
            Route::resource('/reservations/reservation-statuses', ReservationStatusController::class)
                ->only(['edit', 'index']);
            Route::get('/reservations/reservations', [ReservationController::class, 'reservations'])
                ->name('reservations.reservations');
            Route::resource('/reservations', ReservationController::class)
                ->except(['destroy', 'edit', 'create']);

            Route::get('/reservation-pdf/send/{reservation}', [ReservationPdfController::class, 'send'])
                ->name('reservation-pdf.send');
            Route::get('/reservation-pdf/download/{reservation}', [ReservationPdfController::class, 'download'])
                ->name('reservation-pdf.download');

            Route::resource('/restaurant-orders', RestaurantOrderController::class)
                ->only(['index', 'show', 'store']);

            Route::resource('/service-orders', ServiceOrderController::class)
                ->only(['edit', 'show', 'store']);

            // User
            Route::post('/users/change-password', [UserController::class, 'changePassword'])
                ->name('users.change-password');
            Route::get('/users/genders', GenderController::class)
                ->name('users.genders');
            Route::get('/users/roles', RoleController::class)
                ->name('users.roles');
            Route::get('/users/users/{user}', [UserController::class, 'user'])
                ->name('users.user');
            Route::get('/users/users', [UserController::class, 'users'])
                ->name('users.users');
            Route::resource('/users', UserController::class)
                ->except('create');

            // Room Type
            Route::get('/room-types/upload-thumbnails/load', [ThumbnailController::class, 'load']);
            Route::post('/room-types/upload-thumbnails/process', [ThumbnailController::class, 'process']);
            Route::delete('/room-types/upload-thumbnails/revert', [ThumbnailController::class, 'revert']);
            Route::get('/room-types/room-prices/{room_type}', [RoomTypeController::class, 'roomPrices'])
                ->name('room-types.room-prices');
            Route::get('/room-types/room-facilities/{room_type}', [RoomTypeController::class, 'roomFacilities'])
                ->name('room-types.room-facilities');
            Route::get('/room-types/room-types', [RoomTypeController::class, 'roomTypes'])
                ->name('room-types.room-types');
            Route::get('/room-types/facilities', [RoomTypeController::class, 'facilities'])
                ->name('room-types.facilities');
            Route::post('/room-types/upload-thumbnails/{room_type}', [RoomTypeController::class, 'update'])
                ->name('room-types.update');
            Route::post('/room-types/upload-thumbnails/{room_type}', [RoomTypeController::class, 'update'])
                ->name('room-types.update');
            Route::resource('/room-types', RoomTypeController::class)
                ->except('show', 'update');

            // Facility
            Route::get('/facilities/facilities', [FacilityController::class, 'facilities'])
                ->name('facilities.facilities');
            Route::resource('/facilities', FacilityController::class)
                ->except(['create', 'show']);

            // Room
            Route::get('/rooms/room-types', [RoomController::class, 'roomTypes'])
                ->name('rooms.room-types');
            Route::get('/rooms/rooms', [RoomController::class, 'rooms'])
                ->name('rooms.rooms');
            Route::resource('/rooms', RoomController::class)
                ->except(['create', 'show']);

            // Restaurant
            Route::get('/restaurants/restaurants', [RestaurantController::class, 'restaurants'])
                ->name('restaurants.restaurants');
            Route::resource('/restaurants', RestaurantController::class)
                ->except(['create', 'show']);

            // Service
            Route::get('/services/service_units', ServiceUnitController::class)
                ->name('services.service-units');
            Route::get('/services/services', [ServiceController::class, 'services'])
                ->name('services.services');
            Route::resource('/services', ServiceController::class)
                ->except(['create', 'show']);

            // Guest
            Route::get('/guests/guests', [GuestController::class, 'guests'])
                ->name('guests.guests');
            Route::resource('/guests', GuestController::class)
                ->except(['create', 'store']);

            // Report
            Route::get('/reports/reservations', ReservationReportController::class);
            Route::get('/reports/restaurants', RestaurantReportController::class);
            Route::get('/reports/services', ServiceReportController::class);

            // Settings
            Route::resource('/contacts', ContactController::class)
                ->only('create', 'store');
            Route::resource('/copyrights', CopyrightController::class)
                ->only('create', 'store');
            Route::resource('/privacies', PrivacyController::class)
                ->only('create', 'store');
            Route::resource('/policies', PolicyController::class)
                ->only('create', 'store');
        });
    });
});
