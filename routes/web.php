<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\MicrosoftAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Microsoft Login
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/auth/microsoft', [MicrosoftAuthController::class, 'redirect'])
        ->name('microsoft.login');

    Route::get('/auth/microsoft/callback', [MicrosoftAuthController::class, 'callback'])
        ->name('microsoft.callback');

});

/*
|--------------------------------------------------------------------------
| Login Route
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return redirect()->route('microsoft.login');
})->name('login');

/*
|--------------------------------------------------------------------------
| Development Routes (No Auth)
|--------------------------------------------------------------------------
|
| Remove the auth middleware temporarily so you can test
| Dashboard and User Management without Microsoft Login.
|
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/users', [UserController::class, 'index'])
    ->name('users.index');

Route::delete('/users/{user}', [UserController::class, 'destroy'])
    ->name('users.destroy');

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', function () {

    Auth::logout();

    request()->session()->invalidate();

    request()->session()->regenerateToken();

    return redirect('/');

})->name('logout');