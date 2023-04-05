<?php

use App\Http\Controllers\DatabaseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

// Main Page Route
Route::get('/', [HomeController::class, 'index']);

// Databases Route
Route::prefix('database')->group(function() {
    Route::get('/aws', [DatabaseController::class, 'aws']);
    Route::get('/azure', [DatabaseController::class, 'azure']);
    Route::get('/turkcelldc', [DatabaseController::class, 'turkcelldc']);
    Route::fallback([HomeController::class, 'notFoundPage']);
});

// User Profile Route
Route::prefix('user')->group(function() {
    Route::get('account', [UserController::class, 'index']);
    Route::get('/login', [UserController::class, 'login']);
    Route::get('/register', [UserController::class, 'register']);
    Route::get('/forgotPassword', [UserController::class, 'forgotPassword']);
    Route::fallback([HomeController::class, 'notFoundPage']);
});

// Not Found Page
Route::fallback([HomeController::class, 'notFoundPage']);