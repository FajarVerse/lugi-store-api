<?php

use App\Http\Controllers\Order\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum', 'verified')->controller(OrderController::class)->group(function () {
  Route::get('/orders', [OrderController::class, 'index']);
  Route::get('/orders/{order:order_code}', [OrderController::class, 'show']);
  Route::post('/orders', [OrderController::class, 'store']);
});
