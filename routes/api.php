<?php
use App\Http\Controllers\Api\DataApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('/data', DataApiController::class);
    Route::get('/latest', [DataApiController::class, 'latest']);
    Route::get('/random', [DataApiController::class, 'random']);
});
