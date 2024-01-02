@extends('layouts.admin-layout')

@section('admin-content')
    <section class="bg-white">
        <div class="py-8 px-6 mx-auto w-full lg:py-16 rounded-md">
            <x-prev-button>Back</x-prev-button><br><br>
            <x-success-message></x-success-message>
            <x-fail-message></x-fail-message>
            <x-errors></x-errors>
            
            <div class="bg-purple-500 text-purple-100 p-6 rounded-lg shadow-lg mb-8">
                <p class="text-3xl font-bold mb-4 text-white">Stock Request Detail</p>
                <div class="grid grid-cols-2 gap-4 text-white">
                    <div class="bg-purple-600 px-4 py-2 rounded-md">Product Name:</div>
                    <div class="bg-purple-600 px-4 py-2 rounded-md">{{ $productName }}</div>
                    <div class="bg-purple-600 px-4 py-2 rounded-md">Supplier Company:</div>
                    <div class="bg-purple-600 px-4 py-2 rounded-md">{{ $supplierCompanyName }}</div>
                    <div class="bg-purple-600 px-4 py-2 rounded-md">Requested By:</div>
                    <div class="bg-purple-600 px-4 py-2 rounded-md">{{ $staffName }}</div>
                    <div class="bg-purple-600 px-4 py-2 rounded-md">Requested At:</div>
                    <div class="bg-purple-600 px-4 py-2 rounded-md">{{ $createdAt }}</div>
                    <div class="bg-purple-600 px-4 py-2 rounded-md">Quantity:</div>
                    <div class="bg-purple-600 px-4 py-2 rounded-md">{{ $quantity }}</div>
                </div>
            </div>

        </div>
    </section>
@endsection
