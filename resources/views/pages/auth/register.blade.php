@extends('main')
@section('title', 'Signup')
@section('content')
    <section class="bg-gray-50 p-10">
        <link rel="stylesheet" href="{{ asset('css/disabled.css') }}">
        <div
            class="py-12 px-4 mx-auto max-w-2xl lg:py-22 w-full bg-white rounded-lg shadow white:border md:mt-0 sm:max-w-md xl:p-10">
            <a href="{{ route('home') }}"
                class="flex items-center mb-6 text-2xl font-semibold text-gray-900 white:text-white">
                <x-application-logo></x-application-logo>
                <h5 class="ml-5">Fake Pharmacy</h5>
            </a>
            <h1 class="mb-5 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">Sign Up</h1>

            {{-- Errors will be shown here --}}
            <x-errors></x-errors>


            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Email</label>
                        <input type="text" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                            placeholder="name@company.com" required value="{{ old('email') }}">
                    </div>


                    <div class="w-full">
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Username
                        </label>
                        <input type="text" name="username" id="username"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                            placeholder="e.g. Sick_Tiger" required value="{{ old('username') }}">
                    </div>


                    <div class="w-full">
                        <label for="cpr" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">CPR
                        </label>
                        <input type="text" name="cpr" id="cpr"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                            placeholder="000000000" required value="{{ old('cpr') }}">
                    </div>


                    <div class="w-full">
                        <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">First
                            Name</label>
                        <input type="text" name="firstname" id="firstname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                            placeholder="Enter Your First Name" required value="{{ old('firstname') }}">
                    </div>


                    <div class="w-full">
                        <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Last
                            Name</label>
                        <input type="text" name="lastname" id="lastname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                            placeholder="Enter Your Last Name" required value="{{ old('lastname') }}">
                    </div>


                    {{-- DatePicker --}}
                    <div class="w-full">
                        <label for="dob" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Date of
                            Birth</label>
                        <input type="date" name="dob" id="dob"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                            required value="{{ old('dob') }}">
                    </div>


                    <div>
                        <label for="phone_number"
                            class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                            placeholder="+97333000000" required value="{{ old('phone_number') }}">
                    </div>

                    <div class="w-full relative">
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                                required placeholder="Enter your password">
                            <span onClick="togglePasswordVisibility(this, 'password')"
                                class="material-symbols-outlined cursor-pointer pr-2"
                                style="position: absolute; top: 50%; right: 0.15rem; transform: translateY(-50%);">
                                visibility_off
                            </span>
                        </div>
                    </div>

                    <div class="w-full relative">
                        <label for="password_confirmation"
                            class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Confirm Password</label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                                required placeholder="Confirm your password">
                            <span onClick="togglePasswordVisibility(this, 'password_confirmation')"
                                class="material-symbols-outlined cursor-pointer pr-2"
                                style="position: absolute; top: 50%; right: 0.15rem; transform: translateY(-50%);">
                                visibility_off
                            </span>
                        </div>
                    </div>



                    {{-- Policy Agreement --}}
                    <div class="flex items-center">
                        <input id="policy" aria-describedby="policy" type="checkbox"
                            class="w-4 h-3.5 border border-gray-300 bg-gray-50 focus:outline-none focus:ring focus:ring-purple-300"
                            onclick="toggleButton()">
                        <label for="policy" class="ml-3 text-sm text-gray-500 white:text-gray-300 whitespace-nowrap">I
                            agree to the terms and conditions</label>
                    </div>


                </div>


                <button type="submit" id="submitButton"
                    class="my-5 w-full text-white bg-purple-700 hover:bg-primary-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-purple-900 active:bg-purple-700 focus:outline-none focus:ring focus:ring-purple-300"
                    disabled>Sign in</button>

                <p class="text-sm font-white text-gray-500 white:text-gray-400 white:ring-offset-gray-800">
                    Already have an account? <a href="{{ route('login') }}"
                        class="font-medium text-purple-700 hover:text-purple-900 no-underline">Sign in</a>
                </p>

            </form>
        </div>
    </section>
    <script src="{{ asset('js/showPassword.js') }}"></script>
    <script src="{{ asset('js/agreeSubmit.js') }}"></script>

@endsection
