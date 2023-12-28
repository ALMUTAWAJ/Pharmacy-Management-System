@extends('layouts.customer-layout')

@section('customer-content')

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





