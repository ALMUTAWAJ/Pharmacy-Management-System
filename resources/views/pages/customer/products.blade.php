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
 <x-title>{{ __('Products') }}</x-title>
@if($products)
         <div class="grid grid-cols-1 md:grid-cols-5 gap-4 pb-10 mb-4">
          @foreach ($products as $product)
          <x-card
          id="{{$product->id}}"
             image="{{ $product->image }}"
            name="{{ $product->name }}"
             description="{{  Str::limit($product->description, 60)  }}" 
             price="{{$product->price}}"
             stock="{{$product->stock}}"
             rate="{{ number_format($product->average_rating, 1) }}"
            />
            @endforeach
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
         <span class="font-medium">&nbsp; No Products Found.</span>
     </div>
 </div>
@endif 

@endsection





