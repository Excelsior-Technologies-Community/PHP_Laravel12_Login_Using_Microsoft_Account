<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MicrosoftAuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/auth/microsoft', [MicrosoftAuthController::class, 'redirect'])
        ->name('microsoft.login');
        
    Route::get('/auth/microsoft/callback', [MicrosoftAuthController::class, 'callback'])
        ->name('microsoft.callback');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
});