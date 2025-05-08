<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;

class KhaltiPaymentController extends Controller
{
    public function purchase(Request $request)
    {
        try {
            Log::info('Starting Khalti purchase request', ['request' => $request->all()]);
            Log::info('Khalti Secret Key Used', ['key' => env('KHALTI_SECRET_KEY')]);

            // Validate request data
            $data = $request->validate([
                'service_id' => 'required|exists:orders,id',
                'name' => 'required|string',
                'amount' => 'required|numeric',
                'user' => 'required|exists:users,id',
            ]);

            Log::info('Validated data', ['data' => $data]);

            // Fetch the order based on service_id and user
            $order = Order::where('id', $data['service_id'])
                ->where('user_id', auth()->id())
                ->first();

            // If the order is not found or unauthorized access, log and return error
            if (!$order) {
                Log::warning('Unauthorized access attempt on order', ['user_id' => auth()->id(), 'order_id' => $data['service_id']]);
                return response()->json(['message' => 'Unauthorized order access.'], 403);
            }

            // Check if the amount is correct
            if ($order->total_price != $data['amount']) {
                Log::warning('Amount mismatch', ['order_total' => $order->total_price, 'input_amount' => $data['amount']]);
                return response()->json(['message' => 'Invalid amount.'], 422);
            }

            // Prepare payload for Khalti API
            $payload = [
                "return_url" => url('/verify-payment') . '?order_id=' . $order->id,
                "website_url" => url('/'),
                "amount" => $order->total_price * 100,
                "purchase_order_id" => $order->id,
                "purchase_order_name" => $data['name'],
                "customer_info" => [
                    "name" => auth()->user()->name,
                    "email" => auth()->user()->email,
                    "phone" => "9800000000"
                ]
            ];

            Log::info('Payload prepared for Khalti', ['payload' => $payload]);

            // Call Khalti API to initiate the payment
            $response = Http::withHeaders([
                'Authorization' => 'key ' . env('KHALTI_SECRET_KEY')
            ])->post('https://a.khalti.com/api/v2/epayment/initiate/', $payload);

            Log::info('Khalti API response', ['status' => $response->status(), 'body' => $response->json()]);

            // If API response fails, log and return error
            if ($response->failed()) {
                Log::error('Khalti request failed', ['response' => $response->body()]);
                return response()->json([
                    'message' => 'Khalti request failed.',
                    'error' => $response->json()
                ], 500);
            }

            // Return the response data to the frontend
            return response()->json($response->json());

        } catch (\Exception $e) {
            Log::error('Unexpected error during Khalti purchase', ['exception' => $e]);
            return response()->json([
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function verifyPayment(Request $request)
    {
        // Extract order_id and amount from the request
        $orderId = $request->query('order_id');
        $amount = $request->input('amount');  // Not validating the amount or token

        // Find the order by ID
        $order = Order::find($orderId);

        if (!$order) {
            Log::error('Order not found during verifyPayment. Order ID: ' . $orderId);
            return redirect()->route('cart.show')->with('error', 'Order not found.');
        }

        // Update Order: Set payment status to 'completed' and rental status to 'confirmed'
        $order->update([
            'payment_status' => 'completed',
            'rental_status' => 'confirmed',
        ]);

        // Fetch Cart for the user who placed the order
        $userId = $order->user_id;
        $cart = Cart::where('user_id', $userId)
            ->with('items.instrument')
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            Log::warning("No items found in the cart for user ID: $userId");
            return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        }

        // Clear the cart items after successful order processing
        try {
            $cart->items()->delete();
            Log::info("Cart items deleted using relation method for user ID: $userId");
        } catch (\Exception $e) {
            Log::warning("Cart relation delete failed: " . $e->getMessage());
            // Fallback: use direct query to delete cart items
            CartItem::where('cart_id', $cart->id)->delete();
            Log::info("Fallback cart item deletion used for cart ID: " . $cart->id);
        }

        Log::info("Order confirmed and cart cleared successfully for user ID: $userId");

        return redirect()->route('order.confirmation', $order->id)
            ->with('success', 'Your order has been confirmed and paid!');
    }


}
