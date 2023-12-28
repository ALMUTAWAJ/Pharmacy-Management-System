@extends('layouts.customer-layout')

@section('customer-content')
<div class="container mx-auto">

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

    <!-- Order checkout -->
    <div class="grid sm:px-10 lg:grid-cols-2 lg:px-20 xl:px-32 mt-3">
      <div class="px-4 pt-8">
        <p class="text-xl font-medium">Order Summary</p>
        <p class="text-gray-400">Please check your items and personal information</p>
        <table class="mt-4 w-full whitespace-nowrap shadow-sm sm:rounded-lg block cursor-pointer select-none rounded-lg border border-gray-300 p-4">
          <thead>
            <tr class="text-left font-bold bg-white border-gray-100 rounded-lg">
              <x-table-col>Product Name</x-table-col>
              <x-table-col>Price Per Unit</x-table-col>
              <x-table-col>Total Price</x-table-col>
            </tr>
          </thead>
          <tbody>
            @php
              $cart = session('cart', []);
              $totalPrice = 0;
            @endphp
            @foreach($cart as $cartItem)
              @php
                $product = \App\Models\Product::find($cartItem['productID']);
                $itemPrice = $product->price * $cartItem['quantity'];
                $totalPrice += $itemPrice;
              @endphp
              <tr class="bg-white border-gray-100">
                <x-table-col>{{ $cartItem['quantity'] }}x {{ $product->name }}</x-table-col>
                <x-table-col>{{ $product->price }}</x-table-col>
                <x-table-col>{{ $itemPrice }}</x-table-col>
              </tr>
            @endforeach
          </tbody>
        </table>

    <x-errors></x-errors>

    <p class="mt-8 text-lg font-medium">Contact Information</p>
    <div class="mt-5 grid gap-6">
      <div class="relative">
        <label class="block cursor-pointer select-none rounded-lg border border-gray-300 p-4" for="radio_1">
          <div class="flex items-center justify-between">
            <span class="mt-2 ml-5 font-semibold">Name</span>
            <a href="#" class="text-blue-500 text-sm leading-6" data-modal-toggle="contact-modal">Change</a>
          </div>
          <div class="ml-5">
            <div class="flex">
              <p class="text-slate-500 text-sm leading-6">Full name : {{$user->personal->firstname}} {{$user->personal->lastname}}</p>
              <p class="text-slate-500 text-sm leading-6 ml-28">Email : {{$user->email}}</p>
            </div>
            <div class="flex">
              <p class="text-slate-500 text-sm leading-6">Phone number : {{$user->phone_number}}</p>
            </div>
          </div>
        </label>
      </div>
    </div>

<!-- Contact modal -->
<div id="contact-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative w-full max-w-2xl max-h-full">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
      <!-- Modal header -->
      <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
          User Personal Information
        </h3>
        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="contact-modal">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal body -->
      <form action="{{ route('customer.cart.checkout.user') }}" method="POST"> 
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <div class="p-6 space-y-6">
          <div class="flex gap-4">
            <div class="w-1/2">
              <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">First Name</label>
              <input type="text" name="firstname" id="firstname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400" placeholder="Enter Your First Name" required value="{{ $user->personal->firstname ?? old('firstname') }}">
            </div>
            <div class="w-1/2">
              <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Last Name</label>
              <input type="text" name="lastname" id="lastname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400" placeholder="Enter Your Last Name" required value="{{ $user->personal->lastname ?? old('lastname') }}">
            </div>
          </div>
          <div class="flex gap-4">
            <div class="w-full">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Email</label>
              <input type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400" placeholder="name@company.com" required value="{{ $user->email ?? old('email') }}">
            </div>
            <div class="w-full">
              <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Phone Number</label>
              <input type="text" name="phone_number" id="phone_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400" placeholder="+97333441878" required value="{{ $user->phone_number ?? old('phone_number') }}">
            </div>
          </div>
        </div>
        <!-- Modal footer -->
        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
          <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
          <button data-modal-hide="contact-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--Modal end-->
      <div class="relative mt-4">
        <label class="block cursor-pointer select-none rounded-lg border border-gray-300 p-4" for="radio_1">
          <div class="flex items-center justify-between">
            <span class="mt-2 ml-5 font-semibold">Address</span>
            <a href="#" class="text-blue-500 text-sm leading-6" data-modal-toggle="address-modal">Change</a>
          </div>
          <div class="ml-5">
            {{-- <div class="flex">
              <p class="text-slate-500 text-sm leading-6">City : {{ $user->personal->addresses->city }}</p>
              <p class="text-slate-500 text-sm leading-6 ml-28">House : {{ $user->personal->address->house }}</p>
            </div>
            <div class="flex">
              <p class="text-slate-500 text-sm leading-6">Road : {{ $user->personal->address->road }}</p>
              <p class="text-slate-500 text-sm leading-6 ml-28">Block : {{ $user->personal->address->block }}</p>
            </div> --}}
          </div>
        </label>
      </div>
      <!-- Address modal -->
      <div id="address-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                      User Address Information
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="address-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
<!-- Modal body -->
<form action="{{ route('customer.cart.checkout.address') }}" method="POST">
  @csrf
  <input type="hidden" name="user_id" value="{{ $user->id }}">
  <div class="p-6 space-y-6">
    <!-- Radio button list for addresses -->
    @foreach ($user->personal->addresses as $address)
      <div class="flex gap-4">
        <div class="w-full">
          <label class="inline-flex items-center">
            <input type="radio" name="address-id" value="{{ $address->id }}" class="form-radio text-primary-600" {{ $address->id == session('selected_address_id', $user->personal->address_id) ? 'checked' : '' }}>
            <span class="ml-2">{{ $address->city }}, {{ $address->house }}, {{ $address->road }}, {{ $address->block }}</span>
          </label>
        </div>
      </div>
    @endforeach

    <!-- Additional address fields -->
    <h1>Add a new address</h1>
    <div class="flex gap-4">
      <div class="w-full">
        <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
        <input type="text" name="city" id="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter city name" value="{{ old('city') }}">
      </div>
      <div class="w-full">
        <label for="house" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">House</label>
        <input type="text" name="house" id="house" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter house number" value="{{ old('house') }}">
      </div>
    </div>
    <div class="flex gap-4">
      <div class="w-full">
        <label for="road" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Road</label>
        <input type="text" name="road" id="road" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter road number" value="{{ old('road') }}">
      </div>
      <div class="w-full">
        <label for="block" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Block</label>
        <input type="text" name="block" id="block" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter block number" value="{{ old('block') }}">
      </div>
    </div>
  </div>
  <!-- Modal footer -->
  <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
    <button data-modal-hide="address-modal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirm</button>
                    <button data-modal-hide="address-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                  </div>
                </form>
            </div>
        </div>
    </div>
    <!--Modal end-->

{{-- lower --}}
    </div>
    
    <form id="checkout" action="{{ route('customer.order') }}" method="POST" enctype="multipart/form-data">
      @csrf
    <!-- Upload -->
    @if ($hasPrescriptionProduct)
        <div class="relative rounded-lg border border-gray-300 p-4">
            <div class="ml-5">
                <p class="text-xl font-medium">Prescription Required!</p>
                <p class="text-slate-500 text-sm leading-6">Please upload a prescription for the following products:</p>
                <ol class="text-slate-500 text-sm leading-6">
                    @foreach ($prescriptionProducts as $product)
                        <li class="numeric">{{ $product }}</li>
                    @endforeach
                </ol>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-4" for="prescriptions">Upload multiple files</label>
                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="prescriptions" name="prescriptions[]" type="file" multiple>
            </div>
        </div>
    @endif
    
    <!-- Payment section code -->
    <div class="mt-10 bg-gray-50 px-4 pt-8 lg:mt-0">
      <p class="text-xl font-medium">Payment Method</p>
      <p class="text-gray-400">Complete your order by selecting your payment method</p>
    <br>

      <div class="mb-3 flex -mx-2">
        <div class="px-2">
          <label for="type1" class="flex items-center cursor-pointer">
            <input type="radio" class="form-radio h-5 w-5 text-indigo-500" name="payment-method" id="type1" value="type1" onclick="toggleCardDetails(true)" checked>
            <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png" class="h-8 ml-3">
          </label>
        </div>
        <div class="px-2">
          <label for="type2" class="flex items-center cursor-pointer">
            <input type="radio" class="form-radio h-5 w-5 text-indigo-500" name="payment-method" id="type2" value="type2" onclick="toggleCardDetails(false)">
            {{-- <img src="https://www.sketchappsources.com/resources/source-image/PayPalCard.png" class="h-8 ml-3"> --}}Cash on delivery
          </label>
        </div>
    </div>

  <div id="card-details">
    <div class="mb-3">
      <label class="font-bold text-sm mb-2 ml-1">Name on card</label>
      <div>
        <input class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="John Smith" type="text" id="card-name" required/>
        <div class="error-message" id="card-name-error"></div>
      </div>
    </div>
    <div class="mb-3">
      <label class="font-bold text-sm mb-2 ml-1">Card number</label>
      <div>
        <input class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="0000 0000 0000 0000" type="text" id="card-number" name="card-number" required/>
        <div class="error-message" id="card-number-error"></div>
      </div>
    </div>
    <div class="mb-3 -mx-2 flex items-end">
      <!-- Expiration date fields -->
    </div>
    <div class="mb-3 -mx-2 flex items-end">
      <div class="w-1/2 px-2">
        <label class="font-bold text-sm mb-2 ml-1">Expiration Month</label>
        <input class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="MM" type="text" id="expiration-month" required/>
        <div class="error-message" id="expiration-month-error"></div>
      </div>
      <div class="w-1/2 px-2">
        <label class="font-bold text-sm mb-2 ml-1">Expiration Year</label>
        <input class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="YY" type="text" id="expiration-year" required/>
        <div class="error-message" id="expiration-year-error"></div>
      </div>
    </div>
    <div class="mb-10">
      <label class="font-bold text-sm mb-2 ml-1">Security code</label>
      <div>
        <input class="w-32 px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="000" type="text" id="security-code" required/>
        <div class="error-message" id="security-code-error"></div>
      </div>
    </div>
    <div>
    </div>
  </div>

        <!-- Total -->
        <div class="mt-6 border-t border-b py-2">
          <div class="flex items-center justify-between">
            <p class="text-sm font-medium text-gray-900">Subtotal</p>
            <p class="font-semibold text-gray-900">BD {{ number_format($totalPrice, 2) }}</p>
          </div>
          <div class="flex items-center justify-between">
            <p class="text-sm font-medium text-gray-900">Shipping</p>
            <p class="font-semibold text-gray-900">BD 2.00</p>
          </div>
          </div>
          <div class="mt-6 flex items-center justify-between">
            <p class="text-sm font-medium text-gray-900">Total</p>
            <p class="text-2xl font-semibold text-gray-900">BD {{ number_format($totalPrice + 2, 2) }}</p>
          </div>
        {{-- <button type="submit" onclick="validateForm()" class="mt-4 mb-8 w-full rounded-md bg-gray-900 px-6 py-3 font-medium text-white">Place Order</button> --}}
        <button type="submit" onclick="validateForm(event)" class="mt-4 mb-8 w-full rounded-md bg-gray-900 px-6 py-3 font-medium text-white">Place Order</button>
      </div>
    </div>
  </div>
</form>
</div>
</div>


@endsection

<style>
  .error {
    border-color: red;
  }

  .error-message {
    color: red;
    font-size: 0.875rem;
    margin-top: 0.25rem;
  }
  
  .input-error {
    border-color: red;
  }
</style>

<script>
  function toggleCardDetails(show) {
    const cardDetails = document.getElementById('card-details');
    cardDetails.style.display = show ? 'block' : 'none';
  }
  
  function validateForm(event) {
    event.preventDefault(); // Prevent default form submission behavior
    var requiresPrescription = {!! json_encode($hasPrescriptionProduct) !!};
    
    // Check if there are any uploaded prescription files
    if (requiresPrescription) {
      var prescriptionFiles = document.getElementById('prescriptions').files;
      if (prescriptionFiles.length === 0) {
        alert('Please upload the required prescription(s) before placing the order.');
        return;
      }
    }
    
    const type1Radio = document.getElementById('type1');
    const cardNameInput = document.getElementById('card-name');
    const cardNumberInput = document.getElementById('card-number');
    const securityCodeInput = document.getElementById('security-code');
    const expirationMonthInput = document.getElementById('expiration-month');
    const expirationYearInput = document.getElementById('expiration-year');
  
    const cardNameError = document.getElementById('card-name-error');
    const cardNumberError = document.getElementById('card-number-error');
    const securityCodeError = document.getElementById('security-code-error');
    const expirationMonthError = document.getElementById('expiration-month-error');
    const expirationYearError = document.getElementById('expiration-year-error');
  
    cardNameError.textContent = '';
    cardNumberError.textContent = '';
    securityCodeError.textContent = '';
    expirationMonthError.textContent = '';
    expirationYearError.textContent = '';
  
    let isValid = true;
    
    // Validate Card Name
    if (
      type1Radio.checked &&
      (!/^[A-Za-z\s]+$/.test(cardNameInput.value) ||
      cardNameInput.value.trim().length < 2 ||
      cardNameInput.value.trim().length > 50)
    ) {
      cardNameError.textContent =
        'Please enter a valid card name with alphabets only and a logical length (2-50 characters).';
      cardNameInput.classList.add('error');
      isValid = false;
    } else {
      cardNameInput.classList.remove('error');
    }
  
    // Validate Card Number
    if (
      type1Radio.checked &&
      !/^\d{16}$/.test(cardNumberInput.value)
    ) {
      cardNumberError.textContent = 'Please enter a valid 16-digit card number.';
      cardNumberInput.classList.add('error');
      isValid = false;
    } else {
      cardNumberInput.classList.remove('error');
    }
  
    // Validate Security Code
    if (
      type1Radio.checked &&
      !/^\d{3}$/.test(securityCodeInput.value)
    ) {
      securityCodeError.textContent = 'Please enter a valid 3-digit security code.';
      securityCodeInput.classList.add('error');
      isValid = false;
    } else {
      securityCodeInput.classList.remove('error');
    }

    // Validate Expiration Month and Year
    // TODO ! not working properly !
    const currentYear = new Date().getFullYear() % 100;
    const currentMonth = new Date().getMonth() + 1;
    const expirationMonth = parseInt(expirationMonthInput.value, 10);
    const expirationYear = parseInt(expirationYearInput.value, 10);

    if (
      expirationMonth < 1 ||
      expirationMonth > 12 ||
      expirationYear < currentYear ||
      (expirationYear === currentYear && expirationMonth < currentMonth)
    ) {
      expirationMonthError.textContent = 'Please enter a valid expiration date.';
      expirationYearError.textContent = 'Please enter a valid expiration date.';
      expirationMonthInput.classList.add('error');
      expirationYearInput.classList.add('error');
      isValid = false;
    } else {
      expirationMonthInput.classList.remove('error');
      expirationYearInput.classList.remove('error');
    }
  
    if (isValid) {
      // Form validation passed, submit the form
      document.getElementById('checkout').submit();
    }
  }
</script>