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

            <h1 id='title' class="mb-5 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">Reset
                Password</h1>

            <form action="{{ route('forget.password.post') }}" method="POST">
                @csrf

                <div class="sm:col-span-2 relative my-3">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email Address</label>
                    <div class="relative">
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                            placeholder="Enter your email address">
                    </div>
                </div>
               <x-submit-button>Send</x-submit-button>
            </form>
            <x-move-button link='{{route("login")}}'>Back</x-move-button>


    </section>
    <script src="{{ asset('js/showPassword.js') }}"></script>
@endsection
