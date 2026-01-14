<?php

use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->controller(ProductController::class)->group(function () {
  Route::post('/products', [ProductController::class, 'store']);
});
