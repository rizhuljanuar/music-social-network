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

    Route::prefix('songs')->group(function () {
        Route::get('/user/{user_id}', [\App\Http\Controllers\API\SongsByUserController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\API\SongController::class, 'store']);
        Route::delete('/{id}/{user_id}', [\App\Http\Controllers\API\SongController::class, 'destroy']);
    });

    Route::prefix('youtube')->group(function () {
        Route::get('/{user_id}', [\App\Http\Controllers\API\YoutubeController::class, 'show']);
        Route::post('/', [\App\Http\Controllers\API\YoutubeController::class, 'store']);
        Route::delete('/{id}', [\App\Http\Controllers\API\YoutubeController::class, 'destroy']);
    });

    Route::prefix('posts')->group(function () {
        Route::get('/', [\App\Http\Controllers\API\PostController::class, 'index']);
        Route::get('/{id}', [\App\Http\Controllers\API\PostController::class, 'show']);
        Route::get('/user/{user_id}', [\App\Http\Controllers\API\PostByUserController::class, 'show']);
        Route::post('/', [\App\Http\Controllers\API\PostController::class, 'store']);
        Route::put('/{id}', [\App\Http\Controllers\API\PostController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\API\PostController::class, 'destroy']);
    });
});
