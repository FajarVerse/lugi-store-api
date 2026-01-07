<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\ResendVerifyEmailController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', [RegisteredUserController::class, 'store']);
Route::post('/auth/login', [AuthenticatedSessionController::class, 'store']);
Route::delete('/auth/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');
Route::patch('/auth/change_password', [ChangePasswordController::class, 'store'])->middleware('auth:sanctum');
Route::get('/auth/verify-email/{id}/{hash}', VerifyEmailController::class)->middleware('auth:sanctum', 'signed')->name('verification.verify');
Route::post('/auth/resend_verify_email', [ResendVerifyEmailController::class, 'store'])->middleware('auth:sanctum')->name('verification.resend');
