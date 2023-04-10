<?php

use App\Http\Controllers\ClusterController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// System Routes
Route::prefix('/')->group(function() {
    Route::get('/', [SystemController::class, 'index']);
    Route::get('/login', [SystemController::class, 'login']);
    Route::get('/register', [SystemController::class, 'register']);
    Route::get('/forgotPassword', [SystemController::class, 'forgotPassword']);
    Route::fallback([SystemController::class, 'notFound']);
});

// Cluster Routes
Route::prefix('clusters')->group(function() {
    Route::get('/',[ClusterController::class, 'getAllClusters']);
    Route::post('/create', [ClusterController::class, 'createCluster'])->name('clusters.create');
    Route::post('/update', [ClusterController::class, 'updateClusterById'])->name('clusters.update');
    Route::post('/delete', [ClusterController::class, 'deleteClusterById'])->name('clusters.delete');
    Route::fallback([ClusterController::class, 'notFound']);
});

// Database Routes
Route::prefix('databases')->group(function() {
    Route::get('/',[DatabaseController::class, 'index']);
    Route::fallback([DatabaseController::class, 'notFound']);
});

// User Routes
Route::prefix('users')->group(function() {
    Route::get('/',[UserController::class, 'getAllUsers']);
    Route::post('/create', [UserController::class, 'createUser'])->name('users.create');
    Route::post('/update', [UserController::class, 'updateUserById'])->name('users.update');
    Route::post('/delete', [UserController::class, 'deleteUserById'])->name('users.delete');
    Route::get('/profile',[UserController::class, 'profile']);
    Route::fallback([UserController::class, 'notFound']);
});


