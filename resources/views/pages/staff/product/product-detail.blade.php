@extends('layouts.staff-layout')

@section('staff-content')
    <section class="bg-white py-8 px-4 mx-auto max-w-2xl lg:py-16">

        <div class="mb-12">
            <a href="{{ route('manage_products.index') }}">
                <x-prev-button>Cancel</x-prev-button>
            </a>
        </div>

        
            <!-- Larger Product Card -->
            <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md">
                <div class="text-center">
                    <h2 class="text-4xl font-extrabold text-purple-600 bg-white px-4 py-2 rounded-lg shadow-md mb-6 inline-block border-2 border-purple-600">
                        {{ $product->name }}
                    </h2>
                </div>
    <div class="flex flex-col md:flex-row items-start gap-4 md:gap-8 px-4 md:px-8 py-6">

        <!-- Information Cards Section -->
        <div class="w-full md:w-1/2">
            <div class="p-6 flex flex-col gap-6">

                <!-- Information Cards Grid (Left Side) -->
                <div class="grid grid-cols-1 gap-4">
                    <!-- Price Card -->
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <p class="text-lg font-semibold text-purple-500 mb-2">Price:</p>
                        <p class="text-lg">{{ $product->price }}</p>
                    </div>

                    <!-- Category Card -->
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <p class="text-lg font-semibold text-purple-500 mb-2">Category:</p>
                        <p class="text-lg">{{ $product->category }}</p>
                    </div>

                    <!-- Supplier Card -->
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <p class="text-lg font-semibold text-purple-500 mb-2">Supplier:</p>
                        <p class="text-lg">{{ $supplier }}</p>
                    </div>

                    <!-- Stock Card -->
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <p class="text-lg font-semibold text-purple-500 mb-2">Stock:</p>
                        <p class="text-lg">{{ $product->stock }}</p>
                    </div>

                    <!-- Expiry Date Card -->
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <p class="text-lg font-semibold text-purple-500 mb-2">Expiry Date:</p>
                        <p class="text-lg">{{ $product->exp_date }}</p>
                    </div>
                </div>

                <!-- Move Edit Button to the left -->
                <div class="mt-6 md:mt-auto">
                    <a href="{{ route('staff.edit.product', $product->id) }}">
                        <x-secondary-button>
                            {{ __('Edit') }}
                        </x-secondary-button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Description and Image Section (Right Side) -->
        <div class="w-full md:w-1/2 flex flex-col gap-32">
            <!-- Description Card -->
            <div class="bg-white rounded-lg shadow-md p-4 mt-6">
                <p class="text-lg font-semibold text-purple-500 mb-2">Description:</p>
                <p class="text-lg">{{ $product->description }}</p>
            </div>

            <!-- Image -->
            <div class="max-w-xs md:max-w-full">
                <img src="{{ $product->image ? asset('storage/'.$product->image) : url('images/profile.svg') }}" alt="Product Image" class="w-full h-auto rounded-lg">
            </div>
        </div>

    </div>
</div>

        
        

    </section>
@endsection
