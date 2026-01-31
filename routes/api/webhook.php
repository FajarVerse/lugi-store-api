<?php

use App\Http\Controllers\Midtrans\WebhookController;
use Illuminate\Support\Facades\Route;

Route::controller(WebhookController::class)->group(function () {
  Route::post('/webhook/midtrans', [WebhookController::class, 'handlePaymentNotification']);
});
