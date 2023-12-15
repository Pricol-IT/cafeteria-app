<?php

use App\Http\Controllers\User\CanteenController;
use App\Http\Controllers\User\Canteen\MenuMasterController;
use App\Http\Controllers\User\Canteen\MenuSelectionController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::post('/check-date', [App\Http\Controllers\User\UserController::class, 'checkdate'])->name('checkdate');

Route::controller(UserController::class)->prefix('user')->middleware('user')->group(function () { 
    Route::get('/dashboard', 'index')->name('user.dashboard');
    Route::get('/monthly', 'monthly')->name('user.monthly');
    Route::get('/weekly', 'weekly')->name('user.weekly');
    Route::get('/monthly_create', 'monthlycreate')->name('user.monthlycreate');
    Route::post('/monthly_store', 'monthlyStore')->name('user.monthlystore');
    Route::post('/weekly_store', 'weeklyStore')->name('user.weeklystore');
    Route::get('/transaction_history', 'transactionHistory')->name('user.transaction');

    Route::post('/remove-monthly-day/{id}', 'removeMonthlyDay')->name('user.removemonthlyday');

    

});

Route::prefix('canteen')->middleware('canteen')->group(function () { 
    Route::get('/dashboard', [CanteenController::class, 'index'])->name('canteen.dashboard');
    Route::resource('menu_master', MenuMasterController::class);
    Route::resource('menu_selection', MenuSelectionController::class);
    Route::get('/delivery', [CanteenController::class, 'deliveryView'])->name('canteen.deliveryview');
    Route::post('/deliveryStore', [CanteenController::class, 'deliveryStore'])->name('canteen.deliverystore');
});

