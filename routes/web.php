<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backoffice\DashboardController;
use App\Http\Controllers\Backoffice\UserController;
use App\Http\Controllers\Backoffice\EventController as BackofficeEventController;
use App\Http\Controllers\Backoffice\JamaahController;
use App\Http\Controllers\Event\EventController as FrontEventController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/event/list', [FrontEventController::class, 'index'])->name('events.index');
Route::get('/event/{slug}', [FrontEventController::class, 'show'])->name('events.show');
Route::get('/event', function () {
    return redirect('/event/list');
});

Route::get('/', function () {
    return redirect('/login');
});

Route::prefix('backoffice')->name('backoffice.')->middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('users/data', [UserController::class, 'data'])->name('users.data');
    Route::resource('users', UserController::class)->names('users');

    Route::get('data', [BackofficeEventController::class, 'data'])->name('events.data');
    Route::resource('events', BackofficeEventController::class)->names('events');


    Route::get('jamaah/data', [JamaahController::class, 'data'])->name('jamaah.data');
    Route::resource('jamaah', JamaahController::class)->names('jamaah');
});

