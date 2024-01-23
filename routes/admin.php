<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AutoRecoveryController;
use App\Http\Controllers\Admin\Auth\LoginController;



Route::prefix('admin')->group(function () {
    /**
     * Auth routes
     */
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.admin');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::resource('user', UserController::class);
        Route::resource('auto_booking', AutoRecoveryController::class);
        
        Route::post('/checkauto', [AutoRecoveryController::class, 'checkauto'])->name('checkauto');
    });
 });