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

            if ($product && $product->stock >= $cartItem['quantity'] && $product->exp_date >= now()->toDateString()) {
                $itemPrice = $product->price * $cartItem['quantity'];
                $totalPrice += $itemPrice;
            } else {
                // Remove the product from the cart if it is no longer in stock or expired
                unset($cart[array_search($cartItem, $cart)]);
                session(['cart' => $cart]);
                return redirect()->back()->with('error', 'One or more products in your cart are no longer available or expired.');
            }
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