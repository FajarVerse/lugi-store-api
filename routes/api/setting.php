<?php

use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;

Route::put('/settings/profile-update', [ProfileController::class, 'update'])->middleware('auth:sanctum');
