<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleAuthorization;
use App\Http\Middleware\ValidSession;

Route::middleware([ValidSession::class])->group(function () {
    Route::get('/', function () {
        return view('index');
    });
    // Auth Route
    Route::get('/signin', [AuthController::class, 'signin'])->name('auth.signin');
    Route::get('/signup', [AuthController::class, 'signup'])->name('auth.signup');
    Route::post('/signin', [AuthController::class, 'login']);
    Route::post('/signup', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout')->withoutMiddleware([ValidSession::class]);
    ;
});

Route::middleware([RoleAuthorization::class])->group(function () {

    // Users Route
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::post('/users', [UserController::class, 'create'])->name('user.add');
    Route::put('/users/update/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/delete/{user}', [UserController::class, 'delete'])->name('user.delete');

    // Trips Route
    Route::get('/trips', [TripController::class, 'index'])->name('trip.index');
    Route::post('/trips', [TripController::class, 'create'])->name('trip.add');
    Route::get('/trips/{tripId}', [TripController::class, 'show'])->name('trip.show');
    Route::put('/trips/{tripId}', [TripController::class, 'update'])->name('trip.update');
    Route::delete('/trips/{trip}', [TripController::class, 'delete'])->name('trip.delete');

    // Flights
    Route::post('/trips/{tripId}/flight', [TripController::class, 'createFlight'])->name('trip.addFlight');
    Route::put('/trips/{tripId}/flight/{flightId}', [TripController::class, 'updateFlight'])->name('trip.updateFlight');
    Route::delete('/trips/{tripId}/flight/{flightId}', [TripController::class, 'deleteFlight'])->name('trip.deleteFlight');

    // Activities
    Route::post('/trips/{tripId}/activity', [TripController::class, 'createActivity'])->name('trip.addActivity');
    Route::put('/trips/{tripId}/activity/{activityId}', [TripController::class, 'updateActivity'])->name('trip.updateActivity');
    Route::delete('/trips/{tripId}/activity/{activityId}', [TripController::class, 'deleteActivity'])->name('trip.deleteActivity');

    // Lodges
    Route::post('/trips/{tripId}/lodge', [TripController::class, 'createLodge'])->name('trip.addLodge');
    Route::put('/trips/{tripId}/lodge/{lodgeId}', [TripController::class, 'updateLodge'])->name('trip.updateLodge');
    Route::delete('/trips/{tripId}/lodge/{lodgeId}', [TripController::class, 'deleteLodge'])->name('trip.deleteLodge');

});