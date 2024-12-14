<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('Homepage.newappschedule'); // Adjust this to the view you want for the home page
})->name('home');


Route::get('/newappscheduled', [AppointmentController::class, 'newAppSchedule'])->name('newappscheduled');

Route::get('/confirmation_page', function () {
    return view('Homepage.confirmation_page'); // Correctly reference the view in the Homepage folder
})->name('confirmation_page');

Route::get('/pending', [BookingController::class, 'showPending'])->name('pending');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/dashboard', function () {
    return view('dash.dashboard'); // Route to dashboard.blade.php
})->name('dashboard');

Route::post('/store-booking', [BookingController::class, 'store'])->name('store.booking');

Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');

Route::delete('/booking/{id}', [BookingController::class, 'cancel'])->name('booking.cancel');

Route::get('/services/manage', [ServiceController::class, 'index'])->name('services.manage');

Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment');

Route::post('/services/store', [ServiceController::class, 'store'])->name('services.store');
Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');

Route::get('/booking/{id}/edit', [BookingController::class, 'edit'])->name('booking.edit');

Route::put('/booking/{id}', [BookingController::class, 'update'])->name('booking.update');

Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
