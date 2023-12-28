@extends('layouts.admin-layout')

@section('admin-content')
<section style="background-color: transparent;">
    <div class="py-0 px-4 mx-0 my-0 max-w-lg lg:py-16">
        <h1 class="mb-5 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
            Edit User Information
        </h1>
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Errors will be shown here --}}
            <x-errors></x-errors>
            
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="w-full">
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                    <input type="text" value="{{ $user->username }}" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                </div>
                <div class="w-full">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" value="{{ $user->email }}" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                </div>
                <div class="w-full">
                    <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Phone Number</label>
                    <input type="text" value="{{ $user->phone_number }}" name="phone_number" id="phone_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400">
                </div>
                <div class="w-full">
                    <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                    <input type="text" value="{{ $user->personal->firstname }}" name="firstname" id="fname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                </div>
                <div class="w-full">
                    <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                    <input type="text" value="{{ $user->personal->lastname }}" name="lastname" id="lname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                </div>
                <div class="w-full">
                    <label for="cpr" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CPR</label>
                    <input type="text" value="{{ $user->personal->cpr }}" name="cpr" id="cpr" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                </div>
                <div class="w-full">
                    <label for="dob" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Date of Birth</label>
                    <input type="date" value="{{ $user->personal->dob }}" name="dob" id="dob" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400">
                </div>
                <div class="w-full">
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Role</label>
                    <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400" required>
                        <option value="staff" {{ $user->role === "staff" ? 'selected' : '' }}>Staff</option>
                        <option value="admin" {{ $user->role === "admin" ? 'selected' : '' }}>Admin</option>
                        <option value="supplier" {{ $user->role === "supplier" ? 'selected' : '' }}>Supplier</option>
                        <option value="customer" {{ $user->role === "customer" ? 'selected' : '' }}>Customer</option>
                    </select>
                </div>
            </div>

            @foreach ($user->personal->addresses as $index => $address)
            <div class="text-sm mb-2 mt-4">Address {{ $loop->iteration }}</div>
            <div class="border border-black p-4 mb-4 grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="w-full">
                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                    <input type="text" value="{{ $address->city }}" name="addresses[{{ $index }}][city]" id="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter city">
                </div>
        
                <div class="w-full">
                    <label for="road" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Road</label>
                    <input type="text" value="{{ $address->road }}" name="addresses[{{ $index }}][road]" id="road" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter road number">
                </div>
        
                <div class="w-full">
                    <label for="block" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Block</label>
                    <input type="text" value="{{ $address->block }}" name="addresses[{{ $index }}][block]" id="block" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter block number">
                </div>
        
                <div class="w-full">
                    <label for="house" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">House</label>
                    <input type="text" value="{{ $address->house }}" name="addresses[{{ $index }}][house]" id="house" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter house number">
                </div>
            </div>
        @endforeach

            <div class="mt-6">
                <a href="{{route('users.index')}}" class="mr-2"><x-secondary-button>Cancel</x-secondary-button></a>
                <x-primary-button type="submit" id="submit-button">Update</x-primary-button>
            </div>
        </form>
    </div>
</section>
@endsection