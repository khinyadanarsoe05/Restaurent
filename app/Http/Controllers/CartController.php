<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
     public function showProducts()
    {
        $products = Product::all();
      //  dd($products);
        return view('product', compact('products'));
    }

    public function addToCart(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $userId = Auth::id();

    // Try to find existing cart item
    $cart = CartItem::where('user_id', $userId)
                    ->where('product_id', $id)
                    ->first();

    if ($cart) {
        // Update quantity
        $cart->quantity += $request->quantity;
    } else {
        // Create new cart item
        $cart = new CartItem();
        $cart->user_id = $userId;
        $cart->product_id = $id;
        $cart->quantity = $request->quantity;
    }

    $cart->save();

    return redirect()->route('view')->with('success', 'Product added to cart!');
}




    public function showCart()
    {
        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();

        return view('view', compact('cartItems'));
    }

    public function placeOrder()
    {
         $userId = Auth::id();
    $cartItems = CartItem::with('product')->where('user_id', $userId)->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('view')->with('error', 'Your cart is empty.');
    }

    foreach ($cartItems as $item) {
        $price = $item->product->price;
        $quantity = $item->quantity;
        $total = $price * $quantity;

        OrderItem::create([
            'user_id' => $userId,
            'product_id' => $item->product_id,
            'quantity' => $quantity,
            'price' => $price,
            'total_price' => $total,
        ]);
    }

    CartItem::where('user_id', $userId)->delete();

    return redirect()->route('products.list')->with('success', 'Order placed successfully!');
       // CartItem::where('user_id', Auth::id())->delete();
      //  return redirect()->route('products.list')->with('success', 'Order placed successfully!');
    }

    public function updateCart(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $cartItem = CartItem::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    $cartItem->quantity = $request->quantity;
    $cartItem->save();

    return back()->with('success', 'Cart updated!');
}
public function removeCartItem($id)
{
    $cartItem = CartItem::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    $cartItem->delete();

    return back()->with('success', 'Item removed from cart.');
}

}
