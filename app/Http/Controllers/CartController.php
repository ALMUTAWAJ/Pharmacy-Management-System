<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
        Session::start();
    }
    

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

    public function addItem(Request $request, $productId)
    {
        $product = Product::find($productId);

        $cart = session('cart', []);
        $found = false;

        foreach ($cart as &$cartItem) {
            if ($cartItem['productID'] == $productId) {
                $cartItem['quantity'] += 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cartItem = [
                'productID' => $productId,
                'quantity' => 1,
            ];
            $cart[] = $cartItem;
        }

        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    // TODO -- decrement isnt working 
    public function decrementItem(Request $request, $productId)
    {
        $product = Product::find($productId);
    
        $cart = session('cart', []);
        $found = false;
    
        foreach ($cart as &$cartItem) {
            if ($cartItem['productID'] == $productId) {
                $cartItem['quantity'] -= 1;
                if ($cartItem['quantity'] <= 0) {
                    // Call the removeItem function if the quantity reaches zero
                    $this->removeItem($productId);
                }
                $found = true;
                break;
            }
        }
    
        session(['cart' => $cart]);
    
        return redirect()->back()->with('success', 'Product quantity updated successfully.');
    }
}