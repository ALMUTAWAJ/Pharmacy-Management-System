@extends('layouts.customer-layout')

@section('customer-content')
<x-success-message></x-success-message>
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
          <div class="category">
            <span class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Require Prescription?</span>
            <span class="bg-purple-100 text-purple-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-purple-200 dark:text-purple-800 ml-3">{{$product->prescription_req}}</span>
          </div>
          <span class="bg-red-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-purple-200 dark:text-purple-800 ml-3">few in stock!</span>


      <div class="flex items-center mt-2.5 mb-5 ">
          @for ($i=0; $i<5; $i++)
          <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
            </svg>
          @endfor
          <span class="bg-purple-100 text-purple-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-purple-200 dark:text-purple-800 ml-3">{{$product->average_rating}}</span>
      </div>
      <div class="flex items-center justify-between">
        <span class="text-3xl font-bold text-gray-900 dark:text-white block">BHD {{$product->price}}</span>
        <div class="m-4">
          <form action="{{ route('cart.add', ['product' => $product->id]) }}" method="POST">
            @csrf
            <button type="submit" class="w-ful text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
              Add to cart
            </button>
          </form>
        </div>
      </div>
  </div>
</div>

</div>  

  {{--customer reviews  --}}
  <x-title>{{ __('Customer Reviews') }}</x-title>
<!-- component -->



    @if ($product->reviews->isNotEmpty())
        <div class="grid grid-cols-4 gap-4">
            @foreach ($product->reviews as $review)
                <x-card-secondary
                    rate="{{ $review->rate }}"
                    comment="{{ $review->comment }}"
                />
            @endforeach
        </div>
    @else
        <p>No reviews found for this product.</p>
    @endif

   

  {{--end customer reviews  --}}

  @else
  <p>Product not found.</p>
@endif 



@endsection





