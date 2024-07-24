<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});
Route::post('/auth', [AuthController::class, 'authenticate'])->name('auth');

Route::middleware('auth')->group(function () {
    Route::resource('/movie',DataController::class);
    Route::get('/setting', [AuthController::class, 'setting'])->name('setting');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/update-user', [AuthController::class, 'updateSettings'])->name('reset');
});
