<?php
use App\Http\Controllers\Api\DataApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});
Route::get("/galery", [DataApiController::class, 'galery']);
Route::get("/tentang-kami", [DataApiController::class, 'tentangkami']);
Route::get("/menu", [DataApiController::class, 'menu']);
Route::get("/ulasan", [DataApiController::class, 'ulasan']);
