<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Event\EventController as FrontEventController;

// Bypass CSRF verification
// for postman testing
Route::get('event/attendance/info/{registrationId}', [FrontEventController::class, 'getAttendanceInfo'])->name('attendance.info');
Route::post('event/attendance/{registrationId}', [FrontEventController::class, 'markAttendance'])->name('attendance.mark');

// Route::prefix('backoffice')->group(function () {
//     Route::get('event/attendance/info/{registrationId}', [FrontEventController::class, 'getAttendanceInfo']);
//     Route::post('event/attendance/{registrationId}', [FrontEventController::class, 'markAttendance']);
// });