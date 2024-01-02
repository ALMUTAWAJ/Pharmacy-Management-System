@extends('layouts.customer-layout')

@section('customer-content')
            {{-- Errors will be shown here --}}
            <div id="errors">
               <x-errors></x-errors>
           </div>
           {{-- success or fail messages --}}
           <div style="width:500px" id="success">
               <x-success-message></x-success-message>
           </div>
           <div id="fail">
               <x-fail-message></x-fail-message>
           </div>
 <x-title>{{ __('Products') }}</x-title>


     <div class="text-center p-4 mt-4 mb-8">

        <div class="text-center p-4 mt-4 mb-8">

            <div style="width: 67rem; margin-left: 12rem;">
                <form method="GET" action="{{ route('customer.products.index') }}">
                    @csrf
                    <div class="grid grid-cols-4 gap-4">
                        <!-- Search bar -->
                        <div class="col-span-3">
                            <x-search-bar placeholder="Search by name or description" name="search" :value="request('search')" />
                        </div>
                    </div>
                </form>
            </div>
            
    <br>
        
<br>


@if($products&&$products->count()>0)
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
     
     <div align="center">
     <div class="flex items-center p-4 mb-4 text-sm w-2/4  text-red-500 rounded-lg bg-purple-50"
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
</div>
@endif 

@endsection





