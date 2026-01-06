<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', [RegisteredUserController::class, 'store']);
Route::post('/auth/login', [AuthenticatedSessionController::class, 'store']);
Route::delete('/auth/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');
Route::patch('/auth/change_password', [ChangePasswordController::class, 'store'])->middleware('auth:sanctum');
