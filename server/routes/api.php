<?php

use Illuminate\Support\Facades\Route;


Route::post('register', [\App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);

    Route::prefix('users')->group(function () {
        Route::get('/{id}', [\App\Http\Controllers\API\UserController::class, 'show']);
        Route::put('/{id}', [\App\Http\Controllers\API\UserController::class, 'update']);
    });

    Route::get('inside-mware', function () {
        return response()->json('Success', 200);
    });
});
