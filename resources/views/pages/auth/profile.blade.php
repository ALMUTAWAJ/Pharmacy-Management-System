@extends('main')
@section('title', 'Profile')
@section('content')
    <section class="bg-gray-50 p-10">
        <div
            class="py-12 px-4 mx-auto max-w-2xl lg:py-22 w-full bg-white rounded-lg shadow white:border md:mt-0 sm:max-w-md xl:p-10">
            <a href="{{ route('home') }}" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
                <x-application-logo></x-application-logo>
                <h5 class="ml-5">Fake Pharmacy</h5>
            </a>

            <div class="flex justify-center m-5">
                <x-segment-button id=card1-button>General</x-segment-button>
                <x-segment-button id=card2-button>Change Password</x-segment-button>
                <x-segment-button id=card3-button>Addresses</x-segment-button>
            </div>

            <h1 id='title' class="mb-5 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">Customer
                Information</h1>

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

            {{-- Profile Form 1 (General Information) --}}


            <form id='card1' action="{{ route('update.general') }}" method="POST">
                @csrf
                @method('PUT')


                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input type="text" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                            placeholder="name@company.com" required
                            value="{{ old('email') != null ? old('email') : $credential['email'] }}">
                    </div>


                    <div class="w-full">
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username
                        </label>
                        <input type="text" name="username" id="username"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                            placeholder="e.g. Sick_Tiger" required
                            value="{{ old('username') != null ? old('username') : $credential['username'] }}">
                    </div>



                    <div>
                        <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                            placeholder="+9733333333" required
                            value="{{ old('phone_number') != null ? old('phone_number') : $credential['phone_number'] }}">
                    </div>



                    <div class="w-full">
                        <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900">First
                            Name</label>
                        <input type="text" name="firstname" id="firstname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                            placeholder="Enter Your First Name" required
                            value="{{ old('firstname') != null ? old('firstname') : $personal['firstname'] }}">
                    </div>


                    <div class="w-full">
                        <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900">Last
                            Name</label>
                        <input type="text" name="lastname" id="lastname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                            placeholder="Enter Your Last Name" required
                            value="{{ old('lastname') != null ? old('lastname') : $personal['lastname'] }}">
                    </div>

                    <div class="w-full">
                        <label for="cpr" class="block mb-2 text-sm font-medium text-gray-900">CPR
                        </label>
                        <input type="text" name="cpr" id="cpr"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                            placeholder="000000000" required
                            value="{{ old('cpr') != null ? old('cpr') : $personal['cpr'] }}">
                    </div>

                    {{-- DatePicker --}}
                    <div class="w-full">
                        <label for="dob" class="block mb-2 text-sm font-medium text-gray-900">Date
                            of
                            Birth</label>
                        <input type="date" name="dob" id="dob"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                            required value="{{ old('dob') != null ? old('dob') : $personal['dob'] }}">
                    </div>

                </div>


                <button type="submit"
                    class="my-5 w-full text-white bg-purple-700 hover:bg-primary-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-purple-900 active:bg-purple-700 focus:outline-none focus:ring focus:ring-purple-300">Update</button>


            </form>


            {{-- Profile Form 2 (Change Password) --}}

            <form class="hidden" id='card2' action="{{ route('update.password') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2 relative">
                        <label for="old_password" class="block mb-2 text-sm font-medium text-gray-900">Old Password</label>
                        <div class="relative">
                            <input type="password" name="old_password" id="old_password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                                placeholder="••••••••••••••••••••••" required>
                            <span onClick="togglePasswordVisibility(this, 'old_password')"
                                class="material-symbols-outlined cursor-pointer pr-2"
                                style="position: absolute; top: 55%; right: 0rem; transform: translateY(-50%);">
                                visibility_off
                            </span>
                        </div>
                    </div>

                    <div class="sm:col-span-2 relative">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">New Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                                placeholder="••••••••••••••••••••••" required>
                            <span onClick="togglePasswordVisibility(this, 'password')"
                                class="material-symbols-outlined cursor-pointer pr-2"
                                style="position: absolute; top: 55%; right: 0rem; transform: translateY(-50%);">
                                visibility_off
                            </span>
                        </div>
                    </div>

                    <div class="sm:col-span-2 relative">
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Confirm
                            New Password</label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                                placeholder="••••••••••••••••••••••" required>
                            <span onClick="togglePasswordVisibility(this, 'password_confirmation')"
                                class="material-symbols-outlined cursor-pointer pr-2"
                                style="position: absolute; top: 55%; right: 0rem; transform: translateY(-50%);">
                                visibility_off
                            </span>
                        </div>
                    </div>
                </div>





                <button type="submit"
                    class="my-5 w-full text-white bg-purple-700 hover:bg-primary-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-purple-900 active:bg-purple-700 focus:outline-none focus:ring focus:ring-purple-300">Update</button>


            </form>





            {{-- Profile Form 3 (Address) --}}



            <form id="address_selection" method="GET" action="{{ route('fetch.address') }}">
                <div>
                    <label for="address_select" class="block mb-2 text-sm font-medium text-gray-900">Select
                        address</label>
                    <select name="address_select" id="address_select"
                        class="bg-gray-100 border border-gray-300 text-gray-500 text-sm rounded-lg focus:border-purple-500 block w-full p-2.5 border-2 border-solid">
                        @foreach ($addresses as $index => $address)
                            <option value="{{ $addresses->get($index)['id'] }}" {{ isset($chosen_address) && $chosen_address->id == $addresses->get($index)['id'] ? 'selected' : '' }}>
                                {{ "City: $address->city| House: $address->house| Road: $address->road| Block: $address->block" }}
                                {{ $index == 0 ? '(Default) ' : '' }}</option>
                        @endforeach )
                    </select>
                </div><br><br>
            </form>

            <form class="hidden" id='card3' method="POST" action="{{ route('update.address', isset($chosen_address) ? $chosen_address->id : ($addresses->count() > 0 ? $addresses->get(0)['id'] : null)) }}">

                <a href="{{ route('new.address') }}">
                    <x-secondary-button>
                        <span class="material-symbols-outlined">
                            add_box
                        </span>
                        &nbsp Add a new address
                    </x-secondary-button>
                </a><br><br>

                @csrf
                @method('PUT')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

                    <div class="w-full">
                        <label for="city" class="block mb-2 text-sm font-medium text-gray-900">City</label>
                        <input required type="text" name="city" id="city"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                            placeholder="e.g. Manama"
                            value="{{  isset($chosen_address) ? $chosen_address['city'] : $addresses->get(0)['city'] ?? '' }}">
                    </div>

                    <div class="w-full">
                        <label for="house" class="block mb-2 text-sm font-medium text-gray-900">House</label>
                        <input required type="text" name="house" id="house"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                            placeholder="e.g. 1000"
                            value="{{  isset($chosen_address) ? $chosen_address['house'] : $addresses->get(0)['house'] ?? '' }}">
                    </div>

                    <div class="w-full">
                        <label for="road" class="block mb-2 text-sm font-medium text-gray-900">Road</label>
                        <input required type="text" name="road" id="road"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                            placeholder="e.g. 1000"
                            value="{{  isset($chosen_address) ? $chosen_address['road'] : $addresses->get(0)['road'] ?? '' }}">
                    </div>

                    <div class="w-full">
                        <label for="block" class="block mb-2 text-sm font-medium text-gray-900">Block</label>
                        <input required type="text" name="block" id="block"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 focus:outline-none focus:ring focus:ring-purple-300 placeholder-gray-400"
                            placeholder="e.g. 900"
                            value="{{  isset($chosen_address) ? $chosen_address['block'] : $addresses->get(0)['block'] ?? '' }}">
                    </div>

                </div>

                <x-submit-button>Update Address</x-submit-button>
            </form>

        </div>
    </section>
    <script src="{{ asset('js/profile.js') }}"></script>
    <script src="{{ asset('js/showPassword.js') }}"></script>
@endsection
