@extends('layouts.staff-layout')

@section('staff-content')
    <section class="bg-white">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">


            <div class="mb-12">
                <a href="{{ route('manage_products.show', $product->id) }}">
                    <x-prev-button>Cancel</x-prev-button>
                </a>
            </div>


            <x-errors></x-errors>
            <x-fail-message></x-fail-message>
            <x-success-message></x-success-message>
            <h2 class="mb-4 text-xl font-bold text-gray-900">Edit Product</h2>
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Product Name</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border-2 border-solid border-gray-300 text-gray-900 text-sm rounded-lg focus:border-purple-500 block w-full p-2.5"
                            placeholder="Type product name" value="{{ old('name', $product->name) }}">
                    </div>

                    <div class="w-full">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Price(BD)</label>
                        <input type="text" name="price" id="price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-purple-500 block w-full p-2.5 border-2 border-solid"
                            placeholder="e.g. 9.99" value="{{ old('price', $product->price) }}">
                    </div>
                    <div>
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                        <select name="category" id="category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-purple-500 block w-full p-2.5 border-2 border-solid">
                            <option>Select a category</option>
                            <option value="Beauty" {{ old('category', $product->category) === 'Beauty' ? 'selected' : '' }}>
                                Beauty</option>
                            <option value="Medicine"
                                {{ old('category', $product->category) === 'Medicine' ? 'selected' : '' }}>Medicine
                            </option>
                            <option value="Personal Care"
                                {{ old('category', $product->category) === 'Personal Care' ? 'selected' : '' }}>
                                Personal Care</option>
                            <option value="Baby Care"
                                {{ old('category', $product->category) === 'Baby Care' ? 'selected' : '' }}>Baby Care
                            </option>
                        </select>
                    </div>

                    <div>
                        <label for="supplierID" class="block mb-2 text-sm font-medium text-gray-900">Supplier</label>
                        <select name="supplierID" id="supplierID"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-purple-500 block w-full p-2.5 border-2 border-solid">
                            <option>Select product supplier</option>
                            @if (!old('supplierID'))
                                <option value="{{ $selectedSupplier->id }}" selected>
                                    {{ $selectedSupplier->company_name }}
                                </option>
                            @endif
                            @if (isset($suppliers))
                                @foreach ($suppliers as $supplier)
                                    @if ($supplier->id !== $selectedSupplier->id)
                                        <option value="{{ $supplier->id }}">
                                            {{ $supplier->company_name }}
                                        </option>
                                    @endif
                                @endforeach
                            @endif
                            {{-- it should works fine check about it later --}}
                        </select>
                    </div>

                    <div>
                        <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Stock Number</label>
                        <input type="number" name="stock" id="stock"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-purple-500 block w-full p-2.5 border-2 border-solid"
                            placeholder="e.g. 100" value="{{ old('stock') ? old('stock') : $product->stock }}">
                    </div>

                    <style>
                        button.ui-datepicker-current {
                            display: none;
                        }
                    </style>

                    <div>
                        <label for="expiry" class="block mb-2 text-sm font-medium text-gray-900">Expiry Date</label>
                        <div class="relative max-w-sm">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input name="expiry" id="expiry" datepicker type="text"
                                class="bg-gray-50 border border-2 border-solid border-gray-300 text-gray-900 text-sm rounded-lg focus:border-purple-500 block w-full pl-10 p-2.5"
                                placeholder="YYYY/MM/DD" value="{{ old('expiry') ? old('expiry') : $expiry }}">
                        </div>
                    </div>

                    <div class="flex items-center mr-4">
                        <input name="pres_req" {{ $product->prescription_req ? 'checked' : '' }} id="pres_req"
                            type="checkbox" value=""
                            class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500">
                        <label for="pres_req" class="ml-2 text-sm font-medium text-gray-900">Is this product requires a
                            prescription?</label>
                    </div>


                    <div class="sm:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                        <textarea name="description" id="description" rows="8"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:border-purple-500 border-2 border-solid"
                            placeholder="Your description here">{{ old('description') ? old('description') : $product->description }}</textarea>
                    </div>
                </div>

 
                @if ($product->image)
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900">Product Image:</h3>
                        <div class="mt-4 relative w-full h-40 rounded-md border border-gray-300 bg-white overflow-hidden">
                            <div id="image-preview" class="aspect-w-4 aspect-h-3">
                                <img src="{{ old('product-image') ? old('product-image') : asset('storage/' . $product->image) }}"
                                    alt="Product Image" class="object-contain w-full h-full">
                            </div>
                        </div>
                    </div>
                @endif

                <div class="flex items-center justify-center w-full">
                    <label for="product-image"
                        class="mt-5 flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p>
                            <p id="file-name" class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to
                                    upload updated
                                    product image or drag and drop</span></p>
                            <p class="text-xs text-gray-500">SVG, JPEG, or PNG (MAX. 2MB)</p>
                            </p>
                        </div>
                        <input value="" name="product-image" id="product-image" type="file" class="hidden"
                            onchange="previewImage(event)" />
                    </label>
                </div>



                <x-submit-button>Save</x-submit-button>

            </form>
        </div>
    </section>
    <script src="{{ asset('js/product.js') }}"></script>

@endsection
