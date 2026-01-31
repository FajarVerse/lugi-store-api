<?php

namespace App\Http\Controllers\Midtrans;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

use function Illuminate\Support\now;

class WebhookController extends Controller
{
    public function handlePaymentNotification(Request $request)
    {
        \Midtrans\Config::$isProduction = config('midtrans.is_production');;
        \Midtrans\Config::$serverKey = config('midtrans.server_key');

        $notif = new \Midtrans\Notification();

        $orderCode = $notif->order_id;
        $transaction = $notif->transaction_status;


        $order = Order::where('order_code', $orderCode)->first();

        if (!$order) {
            return response()->json([
                'message' => 'Order not found'
            ], 404);
        }

        if ($order->status == 'paid') {
            return response()->json([
                'message' => 'Already processed'
            ], 200);
        }

        if (
            $transaction == 'settlement' ||
            (
                $transaction == 'capture' &&
                $notif->payment_type == 'credit_card' &&
                $notif->fraud_status == 'accept'
            )
        ) {
            $order->status = 'paid';
            $order->paid_at = now();
        } else if ($transaction == 'pending') {
            $order->status = 'pending';
        } else if (in_array($transaction, ['expire', 'deny', 'cancel'])) {
            $order->status = 'failed';
        }

        $order->update([
            'payment_method' => $notif->payment_type,
            'payment_reference' => $notif->transaction_id,
        ]);

        return response()->json([
            'message'  => 'Webhook processed'
        ], 200);


        //     $payload = $request->all();

        //     $orderCode   = $payload['order_id'] ?? null;
        //     $transaction = $payload['transaction_status'] ?? null;

        //     if (! $orderCode || ! $transaction) {
        //         return response()->json(['message' => 'Invalid payload'], 400);
        //     }

        //     $order = Order::where('order_code', $orderCode)->first();

        //     if (! $order) {
        //         return response()->json(['message' => 'Order not found'], 404);
        //     }

        //     if ($order->status === 'paid') {
        //         return response()->json(['message' => 'Already processed'], 200);
        //     }

        //     if (
        //         $transaction === 'settlement' ||
        //         (
        //             $transaction === 'capture' &&
        //             ($payload['payment_type'] ?? null) === 'credit_card' &&
        //             ($payload['fraud_status'] ?? null) === 'accept'
        //         )
        //     ) {
        //         $order->status  = 'paid';
        //         $order->paid_at = now();
        //     } elseif ($transaction === 'pending') {
        //         $order->status = 'pending';
        //     } elseif (in_array($transaction, ['expire', 'deny', 'cancel'])) {
        //         $order->status = 'failed';
        //     }

        //     $order->payment_method    = $payload['payment_type'] ?? null;
        //     $order->payment_reference = $payload['transaction_id'] ?? null;

        //     $order->save();

        //     return response()->json(['message' => 'Webhook processed'], 200);
    }
}
