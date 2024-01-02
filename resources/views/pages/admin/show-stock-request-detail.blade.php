@extends('layouts.admin-layout')

@section('admin-content')
    <section class="bg-white">
        <div class="py-8 px-6 mx-auto w-full lg:py-16 rounded-md">
            <a href="{{route('admin.view.stock_requests')}}">
            <x-prev-button>Back</x-prev-button><br><br>
        </a>
            <x-success-message></x-success-message>
            <x-fail-message></x-fail-message>
            <x-errors></x-errors>
            
            <div class="bg-gray-100 p-6 rounded-lg shadow-lg mb-8">
                <p class="text-3xl font-bold mb-4 text-gray-800">Stock Request Detail</p>
                <div class="grid grid-cols-2 gap-4 text-gray-800">
                    <div class="flex items-center">
                        <div class="w-32 font-semibold">Product Name:</div>
                        <div>{{ $productName }}</div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-40 font-semibold">Supplier Company:</div>
                        <div>{{ $supplierCompanyName }}</div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-32 font-semibold">Requested By:</div>
                        <div>{{ $staffName }}</div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-32 font-semibold">Requested At:</div>
                        <div>{{ $createdAt }}</div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-32 font-semibold">Quantity:</div>
                        <div>{{ $quantity }}</div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
