@extends('layouts.customer-layout')

@section('customer-content')
            {{-- Errors will be shown here --}}
            <div id="errors">
              <x-errors></x-errors>
          </div>
          {{-- success or fail messages --}}
          <div id="success">
              <x-success-message></x-success-message>
          </div>
          <div id="fail">
              <x-fail-message></x-fail-message>
          </div>
@if ($product)
<div class="flex justify-center items-center">
<div class="grid grid-cols-1 md:grid-cols-2 w-full max-w-sm md:max-w-6xl justify-center items-center bg-white shadow rounded-lg  dark:bg-gray-800 dark:border-gray-700">
  <div class="flex justify-center items-center  p-3">
    <a href="#">
      <img class="p-8 h-72 rounded-t-lg " src="/images/{{$product->image}}" alt="product image" />
  </a>
  </div>
  <div class="px-5 md:max-w-4xl pb-5 border ">
          <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$product->name}},{{$product->description}}</h5>
          <div class="category">
            <span class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Category:</span>
            <span class="bg-purple-100 text-purple-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-purple-200 dark:text-purple-800 ml-3">{{$product->category}}</span>
          </div>
          @if ($product->prescription_req)
          <div class="category">
              <span class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Note: this product requires prescription</span>
          </div>
      @endif
      @if ($product->stock <= 10 && $product->stock > 0)
      <span class="bg-red-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-purple-200 dark:text-purple-800 ml-3">Few in stock !</span>
      @endif
      @if ($product->stock == 0)
      <span class="bg-red-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-purple-200 dark:text-purple-800 ml-3">Out of stock</span>
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
  <p>Product not found.</p>
@endif 



@endsection





