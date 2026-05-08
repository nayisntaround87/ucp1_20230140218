<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\CategoryApiController;

Route::post('/login', [AuthController::class, 'getToken']);

Route::get('/product', [ProductApiController::class, 'index']);
Route::get('/product/{id}', [ProductApiController::class, 'show']);

Route::get('/category', [CategoryApiController::class, 'index']);
Route::get('/category/{id}', [CategoryApiController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/product', [ProductApiController::class, 'store']);
    Route::put('/product/{id}', [ProductApiController::class, 'update']);
    Route::delete('/product/{id}', [ProductApiController::class, 'destroy']);

    Route::post('/category', [CategoryApiController::class, 'store']);
    Route::put('/category/{id}', [CategoryApiController::class, 'update']);
    Route::delete('/category/{id}', [CategoryApiController::class, 'destroy']);
});