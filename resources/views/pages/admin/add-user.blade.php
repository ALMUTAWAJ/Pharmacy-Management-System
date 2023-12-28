@extends('layouts.admin-layout')

@section('admin-content')
      {{-- Errors will be shown here --}}
      <x-errors></x-errors>
<section style="background-color: transparent;">
    <form action="{{route('users.store')}}" method="POST" style="display: grid; grid-template-columns: 15fr 1fr 15fr; grid-gap: 20px;">
      @csrf
      <h1 class="mb-5 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl mt-5">
        Add a new staff member</h1>
          <div style="grid-column: 1;">
            <div class="flex gap-4">
                      <div class="w-full">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Email</label>
                        <input type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400" placeholder="name@company.com" required value="{{ old('email') }}">
                      </div>
                      <div class="w-full">
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Username</label>
                        <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400" placeholder="e.g. Sick_Tiger" required value="{{ old('username') }}">
                      </div>
                    </div>
                    <div class="flex gap-4">
                      <div class="w-1/2">
                        <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">First Name</label>
                        <input type="text" name="firstname" id="firstname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400" placeholder="Enter Your First Name" required value="{{ old('firstname') }}">
                      </div>
                      <div class="w-1/2">
                        <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Last Name</label>
                        <input type="text" name="lastname" id="lastname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400" placeholder="Enter Your Last Name" required value="{{ old('lastname') }}">
                      </div>
                    </div>
                    <div class="flex gap-4">
                      <div class="w-1/2">
                        <label for="cpr" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">CPR</label>
                        <input type="text" name="cpr" id="cpr" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400" placeholder="000000000" required value="{{ old('cpr') }}">
                      </div>
                      <div class="w-1/2">
                        <label for="dob" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Date of Birth</label>
                        <input type="date" name="dob" id="dob" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400" required value="{{ old('dob') }}">
                      </div>
                    </div>
                    <div class="flex gap-4">
                      <div class="w-1/2">
                        <div class="w-full">
                          <label for="password" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Password</label>
                          <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400" required placeholder="Enter your password">
                        </div>
                      </div>
                      <div class="w-1/2">
                        <div class="w-full">
                          <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Confirm Password</label>
                          <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400" required placeholder="Confirm your password">
                        </div>
                      </div>
                    </div>
                    <div class="flex gap-4">
                      <div class="w-1/2">
                        <div class="w-full">
                          <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Phone Number</label>
                          <input type="text" name="phone_number" id="phone_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400" placeholder="+97333000000" required value="{{ old('phone_number') }}">
                        </div>
                      </div>
                      <div class="w-1/2">
                        <div class="w-full">
                          <label for="role" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Role</label>
                          <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400" required>
                            <option value="staff">Staff</option> 
                            <option value="admin">Admin</option>
                            <option value="supplier">Supplier</option>
                            <option value="customer">Customer</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    </div>
                   
      <div style="grid-column: 2; border-left: 1px solid black;" class="ml-6"></div>
          <div style="grid-column: 3;">
                    <h1 class="mb-5 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl mt-5">
                        Additional Information
                    </h1>
                    <div style="display: flex;">
                      <div class="w-full">
                        <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                        <input type="text" name="city" id="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter city">
                      </div>
                      <div class="w-full">
                        <label for="road" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Road</label>
                        <input type="text" name="road" id="road" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter road number">
                      </div>
                    </div>
                    <div class="flex gap-4">
                      <div class="w-1/2">
                        <div class="w-full">
                          <label for="block" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Block</label>
                          <input type="text" name="block" id="block" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter block number">
                        </div>
                      </div>
                      <div class="w-1/2">
                        <div class="w-full">
                          <label for="house" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">House</label>
                          <input type="text" name="house" id="house" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter house number">
                        </div>
                      </div>
                    </div>
                <div class="mt-5">
              <a href="{{route('users.index')}}" class="mr-2"><x-secondary-button>Cancel</x-secondary-button></a>
              <x-primary-button type="submit" id="submit-button">Add Member</x-primary-button>
            </div>
            </div>
            </form>
            </section>
@endsection
