<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Personal;
use App\Models\Payment;
use App\Models\Address;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Prescription;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;


class CheckoutController extends Controller
{
    public function showCheckout()
    {
        $cart = session('cart', []);

        $prescriptionProducts = [];
        $hasPrescriptionProduct = false;

        foreach ($cart as $cartItem) {
            $product = Product::find($cartItem['productID']);

            if ($product && $product->prescription_req) {
                $prescriptionProducts[] = $product->name;
                $hasPrescriptionProduct = true;
            }
        }

        $user = auth()->user();

        return view('pages.customer.checkout', compact('prescriptionProducts', 'hasPrescriptionProduct', 'user'));
    }

    public function getPrescriptionProducts($cart)
    {
        $prescriptionProducts = [];
    
        if (!is_null($cart)) {
            $cart = (array) $cart;
    
            foreach ($cart as $cartItem) {
                $product = Product::find($cartItem['productID']);
    
                if ($product) {
                    if ($product->prescription_req) {
                        $prescriptionProducts[] = $product->name;
                    }
                }
            }
        }
    
        return $prescriptionProducts;
    }

    public function updateUserInfo(Request $request)
    {
        $user = User::find($request->user()->id);

        if ($user) {
            $validator = Validator::make($request->all(), [
                'firstname' => ['required', 'string', 'min:3', 'max:25', 'regex:/^[A-Za-z\s]+$/'],
                'lastname' => ['required', 'string', 'min:3', 'max:25', 'regex:/^[A-Za-z\s]+$/'],
                // TODO: Add validation rules for 'phone_number' and 'email' fields
                'email' => "required|email|unique:users,email,{$user->id}",
            ]);

            if ($validator->passes()) {
                $user->update([
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                ]);

                $user->personal->update([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                ]);

                return redirect()->back();
            } else {
                return redirect()->back()->withErrors($validator); 
            }
        }

        return redirect()->back();
    }



    public function updateAddressInfo(Request $request)
    {
        $user = User::find($request->user()->id);
        $selectedAddressId = $request->input('address-id');
        session(['selected_address_id' => $selectedAddressId]);

        if ($user) {
            $rules = [
                'city' => ['string', 'max:255'],
                'house' => ['string', 'max:255'],
                'road' => ['string', 'max:255'],
                'block' => ['string', 'max:255'],
            ];

            $inputs = $request->only(array_keys($rules));

            // Check if all fields are empty
            if (count(array_filter($inputs)) !== 0) {
                $validator = Validator::make($inputs, $rules);

                if ($validator->passes()) {
                    $personal = Personal::where('userID', $user->id)->first();

                    if ($personal) {
                        $address = $personal->addresses()->create([
                            'city' => $request->city,
                            'house' => $request->house,
                            'road' => $request->road,
                            'block' => $request->block,
                        ]);

                        // Set the newly created address as the selected one
                        session(['selected_address_id' => $address->id]);

                        return redirect()->back();
                    }
                }

                return redirect()->back()->withErrors($validator);
            }

            return redirect()->back();
        }

        return redirect()->back();
    }


public function placeOrder(Request $request)
{
    try {
        $userId = $request->user()->id;
        $cart = session('cart', []);
        $totalPrice = 0;
        $hasPrescriptionProduct = false;

        $selectedAddressId = session('selected_address_id', null); // Extract the selected address ID from the session

        if (empty($selectedAddressId)) {
            return redirect()->back()->with('error', 'Please select an address before placing an order.');
        }

        $address = Address::find($selectedAddressId);

        foreach ($cart as $cartItem) {
            $product = Product::find($cartItem['productID']);
        
            if ($product && $product->stock >= $cartItem['quantity'] && $product->exp_date >= now()->toDateString()) {
                $totalPrice += $product->price * $cartItem['quantity'];
        
                if ($product->prescription_req) {
                    $hasPrescriptionProduct = true;
                }
        
                $product->stock -= $cartItem['quantity'];
                $product->save();
            } else {
                return redirect()->back()->with('error', 'One or more products in your cart are unavailable or expired.');
            }
        }

        $status = $hasPrescriptionProduct ? 'pending' : 'accepted';

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty. Please add products before placing an order.');
        }

        $order = Order::create([
            'customerID' => $userId,
            'addressID' => $selectedAddressId, // Set the selected address ID
            'total_price' => $totalPrice + 2,
            'status' => $status,
        ]);

        foreach ($cart as $cartItem) {
            $order->orderDetails()->create([
                'productID' => $cartItem['productID'],
                'quantity' => $cartItem['quantity'],
            ]);
        }

        if ($hasPrescriptionProduct) {
            if ($request->hasFile('prescriptions')) {
                $prescriptions = $request->file('prescriptions');

                foreach ($prescriptions as $prescription) {
                    $filename = $prescription->getClientOriginalName();
                    $path = $prescription->store('prescriptions', 'public');

                    $prescriptionData = [
                        'customerID' => $userId,
                        'orderID' => $order->id,
                        'staffID' => null,
                        'approval' => 0,
                        'prescription_upload' => $path,
                    ];

                    Prescription::create($prescriptionData);
                }
            }
        }

        $method = $request->input('payment-method');

        // Determine the payment method and set the corresponding values
        $paymentMethod = ($method === 'type1') ? 'card' : 'cash';
        $transaction = ($paymentMethod === 'card') ? mt_rand(1_000_000_000, 9_999_999_999) : null;
        $status = ($paymentMethod === 'card') ? 'successful' : 'pending';

        $payment = Payment::create([
            'orderID' => $order->id,
            'status' => $status,
            'amount' => $totalPrice + 2,
            'method' => $paymentMethod,
            'transaction' => $transaction,
        ]);

        session()->forget('cart');

        return view('pages.customer.order', ['order' => $order->id]);
    } catch (\Exception $e) {
        dd($e->getMessage());
    }
}


}

