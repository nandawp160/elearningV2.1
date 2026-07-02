<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// [NONAKTIF - ARSIP] Route::post('/attendance/scan', [\App\Http\Controllers\AttendanceSessionController::class, 'scan']);
