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
                if ($cartItem['quantity'] < $product->stock) {
                    $cartItem['quantity']++;
                    $found = true;
                    break;
                } else {
                    return redirect()->back()->withErrors('The product quantity exceeds the available stock.');
                }
            }
        }
        
        if (!$found) {
            if ($product->stock > 0) {
                $newCartItem = [
                    'productID' => $productId,
                    'quantity' => 1,
                ];
                if ($newCartItem['quantity'] <= $product->stock) {
                    $cart[] = $newCartItem;
                } else {
                    return redirect()->back()->withErrors('The product quantity exceeds the available stock.');
                }
            } else {
                return redirect()->back()->with('fail', 'The product is out of stock.');
            }
        }
        
        session(['cart' => $cart]);
        
        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }


    public function newDecrementItem(Request $request, $productId)
    {
        $cart = session('cart', []);
        
        foreach ($cart as &$cartItem) {
            if ($cartItem['productID'] === $productId) {
                $cartItem['quantity']--;
                
                if ($cartItem['quantity'] <= 0) {
                    $this->removeItem($productId);
                    return redirect()->route('customer.cart')->with('success', 'Product removed from cart.');
                }
                
                break;
            }
        }
        
        session(['cart' => $cart]);
        
        return redirect()->back()->with('success', 'Product quantity updated successfully.');
    }
}