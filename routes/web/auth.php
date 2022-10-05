<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;


Route::middleware('guest')->group(function () {
    Route::prefix('login')->name('login.')->group(function () {
        Route::get('/', [LoginController::class, 'index'])->name('index');
        Route::post('/', [LoginController::class, 'login'])->name('store');
    });
});

Route::middleware('auth')->group(function () {
    Route::any('logout', [LoginController::class, 'logout'])->name('logout');
});