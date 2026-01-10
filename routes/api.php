<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');

require __DIR__ . '/api/user.php';
require __DIR__ . '/api/setting.php';
require __DIR__ . '/api/category.php';
