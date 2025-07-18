<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backoffice\DashboardController;
use App\Http\Controllers\Backoffice\UserController;
use App\Http\Controllers\Backoffice\EventController;
use App\Http\Controllers\Backoffice\JamaahController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', function () {
    return redirect('/login');
});

Route::prefix('backoffice')->name('backoffice.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users/data', [UserController::class, 'data'])->name('users.data');
    Route::resource('users', UserController::class)->names('users');

    Route::get('/events/data', [EventController::class, 'data'])->name('events.data');
    Route::resource('events', EventController::class)->names('events');


    Route::get('/jamaah/data', [JamaahController::class, 'data'])->name('jamaah.data');
    Route::resource('jamaah', JamaahController::class)->names('jamaah');
});

