<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CategoryController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API routes for each resource
Route::apiResource('users', UserController::class);
Route::apiResource('books', BookController::class);
Route::apiResource('loans', LoanController::class);
Route::apiResource('reviews', ReviewController::class);
Route::apiResource('categories', CategoryController::class);
    