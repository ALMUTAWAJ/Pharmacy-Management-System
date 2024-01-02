@extends('main')
@section('title', 'Forget password')
@section('content')
    <section class="bg-gray-50 p-10">
        <div
            class="py-12 px-4 mx-auto max-w-2xl lg:py-22 w-full bg-white rounded-lg shadow white:border md:mt-0 sm:max-w-md xl:p-10">
            <a href="{{ route('home') }}" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
                <x-application-logo></x-application-logo>
                <h5 class="ml-5">Pharmacy</h5>
            </a>


            <h1 id='title' class="mb-5 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">Reset
                Password</h1>

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


            {{-- (Reset Password) --}}


            <form action="{{ route('reset.password.post') }}" method="POST">
                @csrf
                <input type='text' name='token' hidden value="{{$token}}">

                <div class="sm:col-span-2 relative m-3">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">New Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                            placeholder="••••••••••••••••••••••" required>
                        <span onClick="togglePasswordVisibility('password')"
                            class="material-symbols-outlined cursor-pointer pr-2"
                            style="position: absolute; top: 55%; right: 0rem; transform: translateY(-50%);">
                            visibility
                        </span>
                    </div>
                </div>

                <div class="sm:col-span-2 relative m-3">
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Confirm New
                        Password</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                            placeholder="••••••••••••••••••••••" required>
                        <span onClick="togglePasswordVisibility('password_confirmation')"
                            class="material-symbols-outlined cursor-pointer pr-2"
                            style="position: absolute; top: 55%; right: 0rem; transform: translateY(-50%);">
                            visibility
                        </span>
                    </div>
                </div>

                <button type="submit"
                    class="my-5 w-full text-white bg-purple-700 hover:bg-primary-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-purple-900 active:bg-purple-700 focus:outline-none focus:ring focus:ring-purple-300">Update</button>
            </form>


    </section>
    <script src="{{ asset('js/showPassword.js') }}"></script>
@endsection
