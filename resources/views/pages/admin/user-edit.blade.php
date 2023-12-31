@extends('layouts.admin-layout')

@section('admin-content')
<section style="background-color: transparent;">
    <div class="py-0 px-4 mx-0 my-0 max-w-lg lg:py-16">
        <h1 class="mb-5 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
            Edit User Information
        </h1>
        <form action="{{ route('users.update', $user) }}" method="POST" id="form">
            @csrf
            @method('PUT')

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
                        <option value="customer" {{ $user->role === "customer" ? 'selected' : '' }}>Customer</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-between">
                <div class="mt-5 flex text-gray-900 text-sm block w-1/2 p-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash mr-2" viewBox="0 0 16 16"> <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/> <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/> </svg>
                    Select Addresses
                </div>
                <div id="add-address" class="mt-5 flex items-center justify-center border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-1 bg-purple-500 text-white dark:bg-purple-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 pr-3 hover:bg-purple-700 dark:hover:bg-purple-800">
                    <span class="material-symbols-outlined text-2xl leading-none">
                        add_circle
                    </span>
                    <span class="ml-2">Add Address</span>
                </div>
            </div>

            <div id="address-container">
                @foreach ($user->personal->addresses as $index => $address)
                    <div class="text-sm mb-2 mt-4 flex">
                        <input type="checkbox" class="address-checkbox mr-3 ml-1" value="{{ $address->id }}">
                        <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Address {{ $loop->iteration }}</label>
                    </div>

                    <div class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 p-4 mb-4 grid gap-4 sm:grid-cols-2 sm:gap-6">
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
            </div>

            <div class="mt-6">
                <a href="{{route('users.index')}}" class="mr-2"><x-secondary-button>Cancel</x-secondary-button></a>
                <x-primary-button type="submit" id="submit-button">Update</x-primary-button>
            </div>
        </form>
    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Add address 
    document.getElementById('add-address').addEventListener('click', function () {
        addAddress();
    });

        var addressCount = document.querySelectorAll('#address-container > .border').length;

        function addAddress() {
            addressCount++;
            var addressIndex = addressCount;

            var addressTemplate = `
                <div class="text-sm mb-2 mt-4 flex">
                    <input type="checkbox" class="address-checkbox mr-3 ml-1" value="${addressIndex}">
                    <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Address ${addressIndex}</label>
                </div>
            <div class="border border-black p-4 mb-4 grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="w-full">
                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                    <input type="text" name="addresses[${addressCount}][city]" id="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter city">
                </div>

                <div class="w-full">
                    <label for="road" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Road</label>
                    <input type="text" name="addresses[${addressCount}][road]" id="road" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter road number">
                </div>

                <div class="w-full">
                    <label for="block" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Block</label>
                    <input type="text" name="addresses[${addressCount}][block]" id="block" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter block number">
                </div>

                <div class="w-full">
                    <label for="house" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">House</label>
                    <input type="text" name="addresses[${addressCount}][house]" id="house" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter house number">
                </div>
            </div>
        `;

        var addressContainer = document.getElementById('address-container');
        var newAddress = document.createElement('div');
        newAddress.innerHTML = addressTemplate;
        addressContainer.appendChild(newAddress);
    }

    document.getElementById('submit-button').addEventListener('click', function () {
        var addresses = document.querySelectorAll('#address-container .border');
        var formData = [];

        addresses.forEach(function (address) {
            var city = address.querySelector('[name^="addresses"] [name$="[city]"]').value;
            var road = address.querySelector('[name^="addresses"] [name$="[road]"]').value;
            var block = address.querySelector('[name^="addresses"] [name$="[block]"]').value;
            var house = address.querySelector('[name^="addresses"] [name$="[house]"]').value;

            formData.push({
                city: city,
                road: road,
                block: block,
                house: house
            });
        });

        console.log(formData);
    });
});

        // Delete Checked Addresses
        document.getElementById('submit-button').addEventListener('click', function () {
        var selectedAddresses = Array.from(document.getElementsByClassName('address-checkbox'))
            .filter(function (checkbox) {
                return checkbox.checked;
            })
            .map(function (checkbox) {
                return checkbox.value;
            });

        selectedAddresses.forEach(function (addressId) {
            var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'addressesToDelete[]';
            hiddenInput.value = addressId;
            document.getElementById('address-container').appendChild(hiddenInput);
        });

        document.getElementById('form').submit();
    });

</script>


@endsection