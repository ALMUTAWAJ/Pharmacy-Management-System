<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{
    public function showCart()
    {
        $cart = session('cart', []);
        $totalPrice = 0;
    
        foreach ($cart as $cartItem) {
            $product = Product::find($cartItem['productID']);
            $itemPrice = $product->price * $cartItem['quantity'];
            $totalPrice += $itemPrice;
        }
    
        return view('pages.customer.cart', compact('cart', 'totalPrice'));
    }

    public function removeItem($productId)
    {
        $cart = session('cart', []);
        $itemIndex = array_search($productId, array_column($cart, 'productID'));

        if ($itemIndex !== false) {
            array_splice($cart, $itemIndex, 1);
            session(['cart' => $cart]);
        }
        
        return redirect()->route('customer.cart');
    }
}