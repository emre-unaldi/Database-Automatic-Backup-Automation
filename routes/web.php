<?php

use App\Http\Controllers\ClusterController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FtpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// General Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::fallback([LoginController::class, 'notFound']);

// FTP Routes
Route::post('ftp/upload', [FtpController::class, 'uploadToFtp'])->name('ftp.upload');;

Route::middleware('auth')->group(function() {
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
        Route::get('/',[DatabaseController::class, 'getAllDatabases']);
        Route::post('/create', [DatabaseController::class, 'createDatabase'])->name('databases.create');
        Route::post('/update', [DatabaseController::class, 'updateDatabaseById'])->name('databases.update');
        Route::post('/delete', [DatabaseController::class, 'deleteDatabaseById'])->name('databases.delete');
        Route::post('/backup', [DatabaseController::class, 'backupDatabaseById'])->name('databases.backup');
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
    // logs Routes
    Route::prefix('logs')->group(function() {
        Route::get('/',[LogsController::class, 'getAllLogs']);
        Route::post('/clear', [LogsController::class, 'clearLogs'])->name('logs.clear');
        Route::fallback([LogsController::class, 'notFound']);
    });
});

