<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\UlasanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});
Route::post('/auth', [AuthController::class, 'authenticate'])->name('auth');

Route::middleware('auth')->group(function () {
    Route::resource('/movie',DataController::class);
    Route::resource('/galery', GaleryController::class);
    Route::resource('/tentang-kami', TentangKamiController::class);
    Route::resource('/ulasan', UlasanController::class);
    Route::resource('/menu', MenuController::class);
    Route::get('/setting', [AuthController::class, 'setting'])->name('setting');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/update-user', [AuthController::class, 'updateSettings'])->name('reset');
});
