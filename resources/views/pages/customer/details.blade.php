@extends('layouts.customer-layout')

@section('customer-content')
<div class="mt-9">
<div style="width: 81%; margin: 0 auto;">
  {{-- Errors will be shown here --}}
  <div id="errors" style="width: 100%;">
    <x-errors></x-errors>
  </div>
  {{-- success or fail messages --}}
  <div id="success" style="width: 100%;">
    <x-success-message></x-success-message>
  </div>
  <div id="fail" style="width: 100%;">
    <x-fail-message></x-fail-message>
  </div>
</div></div>
@if ($product)
<div class="flex justify-center items-center mt-5">

<div class="grid grid-cols-1 md:grid-cols-2 w-full max-w-sm md:max-w-6xl justify-center items-center bg-white shadow rounded-lg  dark:bg-gray-800 dark:border-gray-700">
  <div class="flex justify-center items-center  p-3">
      <img class="p-8 h-72 rounded-t-lg " src='{{asset("/storage/$product->image")}}' alt="product image" />
  </div>
  <div class="px-5 md:max-w-4xl pb-5 border mt-4">
    <h5 class="mt-5 text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$product->name}}</h5>
    <h5 class="text-sm tracking-tight text-gray-900 dark:text-white">{{$product->name}}, {{$product->description}}</h5>
          <div class="category mt-6">
            <span class="bg-purple-100 text-gray-800 text-base font-semibold mr-2 px-3 py-1 rounded dark:bg-purple-200 dark:text-purple-800 ml-3">{{$product->category}}</span>
          </div>
          @if ($product->prescription_req)
          <div class="category mt-3">
            <span class="bg-gray-100 text-gray-800 text-base font-semibold mr-2 px-3 py-1 rounded dark:bg-purple-200 dark:text-purple-800 ml-3">Requires Prescription !</span>
          </div>
      @endif
      @if ($product->stock <= 10 && $product->stock > 0)
      <div class="mt-3">
      <span class=" mt-3 bg-red-100 text-gray-800 text-base font-semibold mr-2 px-3 py-1 rounded dark:bg-purple-200 dark:text-purple-800 ml-3">Few in stock!</span>
      </div>
      @endif
      @if ($product->stock == 0)
      <div class="mt-3">
      <span class="mt-3 bg-red-100 text-gray-800 text-base font-semibold mr-2 px-3 py-1 rounded dark:bg-purple-200 dark:text-purple-800 ml-3">Out of Stock !</span>
      </div>
      @endif


      <div class="flex items-center justify-between">
        <span class="text-3xl font-bold text-gray-900 dark:text-white block">BHD {{$product->price}}</span>
        <div class="m-4">
          <form action="{{ route('cart.add', ['product' => $product->id]) }}" method="POST">
            @csrf
            @if ($product->stock > 0)
            <button type="submit" class="w-ful text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                Add to cart
            </button>
        @else
            <button type="submit" class="w-ful text-white bg-purple-700 cursor-not-allowed opacity-50 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-purple-600" disabled>
                Out of stock
            </button>
        @endif
          </form>
        </div>
      </div>
  </div>
</div>

</div>  

  @else
  <div class="flex items-center p-4 mb-4 text-sm text-red-500 rounded-lg bg-purple-50"
  role="alert">
  <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
      xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
      <path
          d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
  </svg>
  <span class="sr-only">Info</span>
  <div>
      <span class="font-medium">&nbsp; No Product Found.</span>
  </div>
</div>
@endif 



@endsection





