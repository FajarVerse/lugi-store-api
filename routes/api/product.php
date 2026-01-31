<?php

use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum', 'verified')->controller(ProductController::class)->group(function () {
  Route::get('/products', [ProductController::class, 'index']);
  Route::get('/products/{product:slug}', [ProductController::class, 'show']);
  Route::post('/products', [ProductController::class, 'store']);
  Route::patch('/products/{product}', [ProductController::class, 'update']);
  Route::delete('/products/{product}', [ProductController::class, 'destroy']);
});
