<?php
namespace App;

use Illuminate\Support\Facades\Route;

include base_path('routes/admin.php');
include base_path('routes/users.php');

// Route::fallback(function () {
//     if (request()->is('419')) {
//         return view('errors.419');
//     }

//     return view('errors.404');
// });
Route::fallback(function () {
    return view('users.error');
});


