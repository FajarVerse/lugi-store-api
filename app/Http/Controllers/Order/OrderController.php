<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();

        return response([
            'message' => 'ok',
            'data' => $orders
        ], 200);
    }

    public function show(Order $order)
    {
        $order->load([
            'order_items.variant.product'
        ]);

        return response([
            'message' => 'ok',
            'data' => $order
        ], 200);
    }

    public function store(CreateOrderRequest $request)
    {
        $order = DB::transaction(function () use ($request) {
            $order = Order::create([
                'user_id' => $request->user()->id,
                'order_code' => 'TEMP' . uniqid(),
                'status' => 'pending',
                'total_price' => 0,
                'shipping_address' => $request->shipping_address,
                'payment_method' => $request->payment_method
            ]);

            $total = 0;

            foreach ($request->items as $item) {
                $variant = Variant::lockForUpdate()->with('product')->findOrFail($item['variant_id']);

                $subtotal = $variant->price * $item['quantity'];

                if ($variant->stock < $item['quantity']) {
                    throw new \Exception('stock not available');
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'variant_id' => $variant->id,
                    'price' => $variant->price,
                    'subtotal' => $subtotal,
                    'quantity' => $item['quantity'],
                    'product_name' => $variant->product->name
                ]);

                $variant->decrement('stock', $item['quantity']);

                $total += $subtotal;
            }

            $orderCode = 'ORD-' . date('Ymd') . '-' . str_pad($order->id, 5, '0', STR_PAD_LEFT);

            $order->update([
                'order_code' => $orderCode,
                'total_price' => $total
            ]);

            return $order;
        });

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_code,
                'gross_amount' => (int) $order->total_price
            ],
            'customer_details' => [
                'first_name' => $request->user()->name,
                'email' => $request->user()->email
            ]
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json([
            'message' => 'Order successfully',
            'snap_token' => $snapToken,
            'data' => $order
        ], 201);
    }
}
