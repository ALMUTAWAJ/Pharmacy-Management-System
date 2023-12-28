@extends('layouts.admin-layout')

@section('admin-content')
    <section class="bg-white">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <x-errors></x-errors>
            <x-success-message></x-success-message>
            <x-fail-message></x-fail-message>
            <h2 class="mb-4 text-xl font-bold text-gray-900">Edit Supplier</h2>
            <form action="{{ route('admin.update.supplier', ['id' => $supplier->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="company_name" class="block mb-2 text-sm font-medium text-gray-900">Company Name</label>
                        <input type="text" name="company_name" id="company_name"
                            class="bg-gray-50 border-2 border-solid border-gray-300 text-gray-900 text-sm rounded-lg focus:border-purple-500 block w-full p-2.5"
                            placeholder="Type company name" value="{{ $supplier->company_name }}">
                    </div>

                    <div>
                        <label for="commercial_register" class="block mb-2 text-sm font-medium text-gray-900">Commercial Register</label>
                        <input type="text" name="commercial_register" id="commercial_register"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-purple-500 block w-full p-2.5 border-2 border-solid"
                            placeholder="e.g. 12345678" value="{{ $supplier->commercial_register }}">
                    </div>

                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Phone</label>
                        <input type="text" name="phone" id="phone"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-purple-500 block w-full p-2.5 border-2 border-solid"
                            placeholder="e.g. +97312345678" value="{{ $supplier->phone }}">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-purple-500 block w-full p-2.5 border-2 border-solid"
                            placeholder="example@example.com" value="{{ $supplier->email }}">
                    </div>
                </div>

                <x-submit-button>Update Supplier</x-submit-button>
            </form>
        </div>
    </section>
@endsection
