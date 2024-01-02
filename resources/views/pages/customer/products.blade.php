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
             rate="{{ number_format($product->average_rating, 1) }}"
            />
            @endforeach
     </div>

     @else
  <p>No products found</p>
@endif 

@endsection





