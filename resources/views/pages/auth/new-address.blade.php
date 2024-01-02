@extends('main')
@section('title', 'New Address')
@section('content')
    <section class="bg-gray-50 p-10">
        <div class="py-12 px-4 mx-auto max-w-2xl lg:py-22 w-full bg-white rounded-lg shadow white:border md:mt-0 sm:max-w-md xl:p-10">
            <a href="{{ route('home') }}" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
                <a href="{{route('profile')}}"><x-prev-button></x-prev-button></a>
                <x-application-logo></x-application-logo>
                <h5 class="ml-5">Our Pharmacy</h5>
            </a>
            <h1 id='title' class="mb-5 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">Add a new Address</h1>

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

            <form action="{{ route('new.address.add') }}" method="POST">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="w-full">
                        <label for="city" class="block mb-2 text-sm font-medium text-gray-900">City</label>
                        <input value="{{old('city')}}" required type="text" name="city" id="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400" placeholder="e.g. Manama" value="">
                    </div>
                    <div class="w-full">
                        <label for="house" class="block mb-2 text-sm font-medium text-gray-900">House</label>
                        <input  value="{{old('house')}}"  required type="text" name="house" id="house" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400" placeholder="e.g. 1000" value="">
                    </div>
                    <div class="w-full">
                        <label for="road" class="block mb-2 text-sm font-medium text-gray-900">Road</label>
                        <input  value="{{old('road')}}"  required type="text" name="road" id="road" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400" placeholder="e.g. 1000" value="">
                    </div>
                    <div class="w-full">
                        <label for="block" class="block mb-2 text-sm font-medium text-gray-900">Block</label>
                        <input  value="{{old('block')}}"  required type="text" name="block" id="block" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400" placeholder="e.g. 900" value="">
                    </div>
                </div>

                <br>
                <x-submit-button>Add Address</x-submit-button>
            </form>
        </div>
    </section>
@endsection
