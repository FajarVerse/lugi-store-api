<?php

use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->controller(ProfileController::class)->group(function () {
  Route::get('/settings', [ProfileController::class, 'index']);
  Route::patch('/settings/profile-update', [ProfileController::class, 'update']);
  Route::delete('/settings/profile-delete', [ProfileController::class, 'destroy']);
});
