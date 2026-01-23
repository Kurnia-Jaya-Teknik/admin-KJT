<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::middleware(['auth:sanctum', \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class])->group(function(){
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

    // Employee area
    Route::get('/employee/dashboard', [\App\Http\Controllers\Api\Employee\DashboardController::class, 'index']);
    Route::get('/employee/profile', [\App\Http\Controllers\Api\Employee\ProfileController::class, 'show']);
    Route::put('/employee/profile', [\App\Http\Controllers\Api\Employee\ProfileController::class, 'update']);

    Route::get('/employee/requests', [\App\Http\Controllers\Api\Employee\RequestController::class, 'index']);
    Route::post('/employee/requests', [\App\Http\Controllers\Api\Employee\RequestController::class, 'store']);
    Route::put('/employee/requests/{cuti}', [\App\Http\Controllers\Api\Employee\RequestController::class, 'update']);
    Route::delete('/employee/requests/{cuti}', [\App\Http\Controllers\Api\Employee\RequestController::class, 'destroy']);

});
