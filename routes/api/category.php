<?php

use App\Http\Controllers\Category\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->controller(CategoryController::class)->group(function () {
  Route::get('/categories', [CategoryController::class, 'index']);
  Route::get('/categories/{category:slug}', [CategoryController::class, 'show']);
  Route::post('/categories', [CategoryController::class, 'store']);
  Route::patch('/categories/{category}', [CategoryController::class, 'update']);
  Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
});
