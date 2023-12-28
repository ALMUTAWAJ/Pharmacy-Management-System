@extends('layouts.staff-layout')

@section('staff-content')
    <section class="bg-white">
        
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16  rounded-md">
            <x-success-message></x-success-message>
            <x-fail-message></x-fail-message>
      

            <form method="GET" action="{{ route('staff.view.product') }}">
                @csrf
                <div class="grid grid-cols-4 gap-4">
                    <!-- Search bar -->
                    <div class="col-span-3">
                        <x-search-bar placeholder="Search by name or description" name="search"
                            :value="request('search')" />
                    </div>
                    <!-- Dropdown -->
                    <div class="col-span-1">
                        <x-dropdown-input triggerText="{{ ucfirst(request('filter_type')==null ? 'All':request('filter_type')) }}">
                            <div class="cursor-pointer hover:bg-gray-100 p-2" onclick="selectFilter('')">All</div>
                            <div class="cursor-pointer hover:bg-gray-100 p-2" onclick="selectFilter('Beauty')">Beauty</div>
                            <div class="cursor-pointer hover:bg-gray-100 p-2" onclick="selectFilter('Baby Care')">Baby Care
                            </div>
                            <div class="cursor-pointer hover:bg-gray-100 p-2" onclick="selectFilter('Medicine')">Medicine
                            </div>
                            <div class="cursor-pointer hover:bg-gray-100 p-2" onclick="selectFilter('Personal Care')">
                                Personal Care</div>
                        </x-dropdown-input>
                        <input type="hidden" id="filter_type" name="filter_type" value="{{ request('filter_type') }}" />
                    </div>
                </div>
            </form>
            <br>
            <!-- display data -->
            <x-table>
                <tr>
                <x-slot name="header">
                    <x-table-col>Product ID</x-table-col>
                    <x-table-col>Product Name</x-table-col>
                    <x-table-col>Stock</x-table-col>
                    <x-table-col>Expiry Date</x-table-col>
                    <x-table-col>Actions</x-table-col>
                </x-slot>
            </tr>
            <br>
                @if (($searchQuery||$filter!=null) && $products->isEmpty())
                    <tr>
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
                    </tr>

                @else
                @if (!$searchQuery && $products->isEmpty())
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
                    @else
                    @foreach ($products as $product)
                        <tr class="border">
                            <x-table-col>{{ $product->id }}</x-table-col>
                            <x-table-col>{{ $product->name }}</x-table-col>
                            <x-table-col>{{ $product->stock }}</x-table-col>
                            <x-table-col>{{ $product->exp_date }}</x-table-col>
                            <x-table-col>
                                <form action="{{route('manage_products.destroy',$product->id)}}" method="POST"
                                    onsubmit="showDeleteConfirmation(event);">
                                    <a href="{{route('manage_products.show',$product->id)}}">
                                        <x-secondary-button>
                                            {{ __('Details') }}
                                        </x-secondary-button>
                                    </a>

                                    <a href="{{route('prepare.email',$product->id)}}">
                                        <x-secondary-button>
                                            {{ __('Request') }}
                                        </x-secondary-button>
                                    </a>

                                    @csrf
                                    @method('DELETE')
                                    <x-delete-button type="submit" class="btn">Delete</x-delete-button>
                                </form>
                            </x-table-col>
                        </tr>
                    @endforeach
                    @endif
                @endif
                </x-table>

            </form>
            <br><br>
            <div>
                <x-move-button link="{{route('staff.add.product')}}">
                    Add Products
                </x-move-button></div>
               
        </div>
    </section>


 
<script src="{{ asset('js/product.js') }}"></script>

@endsection
