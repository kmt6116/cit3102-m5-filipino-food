<?php

use App\Http\Controllers\FilipinoFoodController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [FilipinoFoodController::class, 'register']);
Route::post('/login', [FilipinoFoodController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [FilipinoFoodController::class, 'logout']);
    Route::get('/me', [FilipinoFoodController::class, 'me']);
    Route::apiResource('foods', FilipinoFoodController::class);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
