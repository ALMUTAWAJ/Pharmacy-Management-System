@extends('layouts.customer-layout')

@section('customer-content')

@if (session('error'))
<div class="sm:px-10 lg:grid-cols-2 lg:px-20 xl:px-32">
  <div class="relative rounded-lg border border-red-300 p-4">
    <div class="text-red-600">
        {{ session('error') }}
    </div>
  </div>
</div> 
<br>
@endif

<div class="container mx-auto mt-10">
  <div class="flex flex-col md:flex-row shadow-md my-10">
    <div class="md:w-3/4 bg-white px-10 py-10">
      <div class="flex justify-between border-b pb-8">
        <h1 class="font-semibold text-2xl">Shopping Cart</h1>
        <h2 class="font-semibold text-2xl">{{ count($cart) }} Items</h2>
      </div>
      <div class="flex mt-10 mb-5">
        <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
        <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5">Quantity</h3>
        <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5">Price</h3>
        <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5">Total</h3>
      </div>

      @php
      $totalPrice = 0;
      @endphp
      {{-- TODO update quantity in the session itself  --}}
      @foreach ($cart as $cartItem)
      @php
      $product = \App\Models\Product::find($cartItem['productID']);
      $itemPrice = $product->price * $cartItem['quantity'];
      $totalPrice += $itemPrice;
      @endphp

      <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
        <div class="flex w-full md:w-2/5">
          <div class="w-20">
            <img class="h-24" src="{{ $product->image }}" alt="{{ $product->name }}">
          </div>
          <div class="flex flex-col justify-between ml-4 flex-grow">
            <span class="font-bold text-sm">{{ $product->name }}</span>
            <span class="text-red-500 text-xs">{{ $product->category }}</span>
            <a href="{{ route('cart.remove', $cartItem['productID']) }}" class="font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</a>
          </div>
        </div>
        <div class="flex justify-center w-full md:w-1/5">
          <button class="quantity-btn minus-btn" onclick="decrementQuantity(this)">-</button>
          <input class="mx-2 border text-center w-12 quantity-input" type="text" value="{{ $cartItem['quantity'] }}" data-product-id="{{ $cartItem['productID'] }}">
          <button class="quantity-btn plus-btn" onclick="incrementQuantity(this)">+</button>
        </div>
        <span class="text-center w-full md:w-1/5 font-semibold text-sm">BD {{ $product->price }}</span>
        <span class="text-center w-full md:w-1/5 font-semibold text-sm">BD {{ $itemPrice }}</span>
      </div>
      @endforeach

      @if (count($cart) === 0)
      <p>No products in the cart.</p>
      @endif

      <a href="{{ route('customer.index') }}" class="flex font-semibold text-indigo-600 text-sm mt-10">
        <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512"></svg>
        Continue Shopping
      </a>
    </div>

    <div id="summary" class="w-1/4 px-8 py-10">
      <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
      <div class="flex justify-between mt-10 mb-5">
        <span class="font-semibold text-sm">Items{{ count($cart) }}</span>
        <span class="font-semibold text-sm">BD {{ $totalPrice }}</span>
      </div>
      <div>
        <label class="font-medium inline-block mb-3 text-sm">Shipping</label>
        <select class="block p-2 text-gray-600 w-full text-sm">
          <option>Standard shipping - BD 2.00</option>
        </select>
      </div>
      <div class="border-t mt-8">
        <div class="flex font-semibold justify-between py-6 text-sm">
          <span>Total cost</span>
          <span>BD {{ $totalPrice }}</span>
        </div>
        <a href="{{ route('customer.checkout') }}">
          <button class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white w-full <?php echo empty($cart) ? 'bg-gray-400 hover:bg-gray-400 cursor-not-allowed' : ''; ?>" <?php echo empty($cart) ? 'disabled' : ''; ?>>Checkout</button>
        </a>
      </div>
    </div>
  </div>
</div>

<script>
  function incrementQuantity(btn) {
    var input = btn.parentNode.querySelector('.quantity-input');
    var productId = input.getAttribute('data-product-id');
    var quantity = parseInt(input.value);
    input.value = quantity + 1;

    updateCartQuantity(productId, quantity + 1, 'increment');
  }

  function decrementQuantity(btn) {
    var input = btn.parentNode.querySelector('.quantity-input');
    var productId = input.getAttribute('data-product-id');
    var quantity = parseInt(input.value);
    input.value = quantity - 1;

    updateCartQuantity(productId, quantity - 1, 'decrement');
  }

  function updateCartQuantity(productId, quantity, action) {
    var url;
    var method;

    if (action === 'increment') {
      url = '/add-to-cart/' + productId;
      method = 'POST';
    } else if (action === 'decrement') {
      url = '/cart/decrement/' + productId;
      method = 'POST';
    }

    fetch(url, {
      method: method,
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({ quantity: quantity })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Update the cart HTML if necessary
        location.reload(); // Refresh the page after successful quantity update
      } else {
        console.error('An error occurred while updating the quantity.');
      }
    })
    .catch(error => {
      console.error('An error occurred while updating the quantity:', error);
    });
  }
</script>
@endsection
