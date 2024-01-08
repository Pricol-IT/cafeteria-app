<?php

use App\Http\Controllers\User\CanteenController;
use App\Http\Controllers\User\Canteen\MenuMasterController;
use App\Http\Controllers\User\Canteen\MenuSelectionController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckController;

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

Route::get('/checkuser/{id}', [App\Http\Controllers\CheckController::class, 'checkuser'])->name('checkuser');

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
    Route::get('/weekly_menu', 'weeklyIndex')->name('user.weeklyindex');
    Route::post('/remove-monthly-day/{id}', 'removeMonthlyDay')->name('user.removemonthlyday');
    Route::post('/remove-weekly-day/{id}', 'weeklyRemove')->name('user.removeweeklyday');
    Route::get('/report', 'userReport')->name('user.userReport');
    Route::get('/profile', 'userProfile')->name('user.profile');
    Route::get('/forget_password','password')->name('user.password');
    Route::post('/reset_password','passwordreset')->name('user.reset');

});

Route::prefix('canteen')->middleware('canteen')->group(function () { 
    Route::get('/dashboard', [CanteenController::class, 'index'])->name('canteen.dashboard');
    Route::resource('menu_master', MenuMasterController::class);
    Route::resource('menu_selection', MenuSelectionController::class);
    Route::get('/sp_delivery', [CanteenController::class, 'deliverySpm'])->name('canteen.deliverySpm');
    Route::get('/si_delivery', [CanteenController::class, 'deliverySim'])->name('canteen.deliverySim');
    Route::post('/deliveryStore', [CanteenController::class, 'deliveryStore'])->name('canteen.deliverystore');
    Route::get('/total', [CanteenController::class, 'total_month_request'])->name('canteen.total_request');
    Route::get('/today', [CanteenController::class, 'singleday_request'])->name('canteen.today');
    Route::get('/synk', [CanteenController::class, 'syncTokenDetails'])->name('canteen.synk');
    Route::get('/usertoken', [CanteenController::class, 'usertoken'])->name('canteen.usertoken');
    Route::get('/reports', [CanteenController::class, 'reports'])->name('canteen.reports');
    Route::get('/livereports', [CanteenController::class, 'livecount'])->name('canteen.livereport');
});

