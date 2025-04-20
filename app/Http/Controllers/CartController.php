<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Drinks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart($id)
    {
        // Find the product
        $product = Drinks::findOrFail($id);
    
        // Get the cart for the logged-in user, or create one if it doesn't exist
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
    
        // Check if the product is already in the cart
        $cartItem = $cart->items()->where('drink_id', $product->id)->first();
    
        if ($cartItem) {
            // If it exists, increment the quantity
            $cartItem->increment('quantity');
        } else {
            $cart->items()->create([
                'drink_id' => $product->id,
                'quantity' => 1
            ]);
        }
    
        return redirect()->back()->with('success', $product->name . ' added to cart!');
    }
    

    public function showCart()
    {
        // Retrieve the cart with related products
        $cart = Cart::with('cartItems.drink')->where('user_id', auth()->id())->first();
        // Return an empty array if the cart is not found
        $cartItems = $cart ? $cart->items : [];
        return view('pages.cart.show', compact('cartItems'));
    }

    public function updateCart(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.show')->with('success', 'Cart updated successfully!');
    }
    public function removeFromCart($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart.show')->with('success', 'Item removed from cart!');
    }

}

