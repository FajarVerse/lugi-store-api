<?php

use App\Http\Controllers\Category\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->controller(CategoryController::class)->group(function () {
  Route::post('/categories', [CategoryController::class, 'store']);
});
