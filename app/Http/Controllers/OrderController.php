<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        DB::beginTransaction();
    
        try {
            $user = Auth::user();
    
            $cart = Cart::with('cartItems.drink')->where('user_id', $user->id)->first();
    
            if (!$cart || $cart->cartItems->isEmpty()) {
                return redirect()->back()->with('error', 'Your cart is empty.');
            }
    
            $total = $cart->cartItems->sum(function ($item) {
                return $item->drink->price * $item->quantity;
            });
    
            // Create the main order
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $total,
                'payment_status' => 'pending',
            ]);
    
            // Create order items
            foreach ($cart->cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'drink_id' => $cartItem->drink->id, // Assuming you have this in your OrderItem model
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->drink->price,
                ]);
            }
    
            // Clear the cart
            $cart->cartItems()->delete();
            $cart->delete();
    
            DB::commit();
    
            return redirect()->route('order.confirmation', $order->id)
            ->with('success', 'Your order has been placed successfully!');    
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }
    public function confirmation(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        return view('pages.order_confirmation', compact('order'));
    }



public function index()
{
    // Eager load order items and drinks to avoid N+1 query issues
    $orders = Order::with('items.drink')->get();

    return view('admin.orders.index', compact('orders'));
}
public function show($id)
{
    $order = Order::with(['items.drink', 'user'])->findOrFail($id);
    return view('admin.orders.show', compact('order'));
}

// Update status
public function updateStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);
    $request->validate([
        'payment_status' => 'required|in:pending,processing,completed',
    ]);
    $order->payment_status = $request->payment_status;
    $order->save();

    return redirect()->route('admin.orders.show', $order->id)->with('success', 'Order status updated!');
}


public function cancel(Order $order)
{
    // Optional: Ensure the logged-in user owns this order
    if ($order->user_id !== auth()->id()) {
        return redirect()->back()->with('error', 'Unauthorized action.');
    }

    if ($order->payment_status !== 'pending') {
        return redirect()->back()->with('error', 'Only pending orders can be canceled.');
    }

    $order->payment_status = 'cancelled';
    $order->save();

    return redirect()->back()->with('success', 'Order has been cancelled.');
}

}
