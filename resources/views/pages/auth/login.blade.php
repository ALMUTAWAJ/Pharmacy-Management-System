@extends('main')
@section('title', 'Login')
@section('content')
    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow white:border md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <a href="{{ route('home') }}"
                        class="flex items-center mb-6 text-2xl font-semibold text-gray-900 white:text-white">
                        <x-application-logo></x-application-logo>
                        <h5 class="ml-5">Pharmacy</h5>
                    </a>
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Sign in to your account
                    </h1>
                    <x-errors></x-errors>
                    <x-success-message></x-success-message>
                    <x-fail-message></x-fail-message>

{{-- maximum 3 times user can try --}}
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login.post') }}">
                        @csrf
                        <div>
                            <label for="username_or_email" class="block mb-2 text-sm font-medium text-gray-900">
                                Username or Email</label>
                            <input type="username_or_email" name="username_or_email" id="username_or_email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300"
                                placeholder="name@company.com"
                                value="{{ old('username_or_email') != null ? old('username_or_email') : '' }}">
                        </div>
                        <div style="position: relative;">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Password</label>
                            <div style="position: relative;">
                                <input type="password" name="password" id="password" placeholder="•••••••••••"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 placeholder-gray-400 focus:outline-none focus:ring focus:ring-purple-300">
                                <span class="material-symbols-outlined" id="password-toggle" onclick="togglePasswordVisibility(this, 'password')"
                                    style="position: absolute; right: 1rem; bottom:0.5rem; cursor: pointer;">
                                    visibility_off
                                </span>
                            </div>
                        </div>
                        
                        

                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" aria-describedby="remember" type="checkbox" name="remember"
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:outline-none focus:ring focus:ring-purple-300">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500 white:text-gray-300">Remember me</label>
                                </div>
                            </div>
                            <a class="text-sm font-medium text-purple-700 hover:text-purple-900 no-underline" href="{{ route('forget.password') }}">Forget Password?</a>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-purple-700 hover:bg-primary-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-purple-900 active:bg-purple-700 focus:outline-none focus:ring focus:ring-purple-300">Sign
                            in</button>


                        <p class="text-sm font-dark text-gray-500 white:text-gray-400 white:ring-offset-gray-800">
                            Don't have an account yet? <a href="{{ route('register') }}"
                                class="font-medium text-purple-700 hover:text-purple-900 no-underline">Sign up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/showPassword.js') }}"></script>
@endsection
