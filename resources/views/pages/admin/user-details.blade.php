@extends('layouts.admin-layout')

@section('admin-content')
    <div class="flex justify-between mb-4">
        <div>
            <h2 class="text-xl font-semibold">User Information</h2>
        </div>
        <div>
            <a href="{{ route('users.index') }}" class="mr-2">
                <x-prev-button></x-prev-button>
            </a>
        </div>
    </div>

    <div class="flex">
        <div class="w-1/2 pr-2">
            <x-table class="border" header="">
                @php
                    $fields1 = [
                        ['ID', $user->id],
                        ['Username', $user->username],
                        ['First name', $user->personal->firstname],
                        ['Last name', $user->personal->lastname],
                        ['Email', $user->email],
                        ['Phone number', $user->phone_number],
                        ['Role', $user->role],
                    ];
                @endphp

                @foreach ($fields1 as $field)
                    <tr class="border">
                        <x-table-col>
                            <strong>{{ $field[0] }}</strong>
                        </x-table-col>
                        <x-table-col>{{ $field[1] }}</x-table-col>
                    </tr>
                @endforeach
            </x-table>
        </div>

        <div class="w-1/2 pl-2">
            <x-table class="border" header="">
                @php
                    $addresses = $user->personal->addresses;
                @endphp

                @foreach ($addresses as $address)
                    <tr class="border">
                        <x-table-col>
                            <strong>Address</strong>
                        </x-table-col>
                        <x-table-col>{{ $address->city }}, {{ $address->house }}, {{ $address->road }}, {{ $address->block }}</x-table-col>
                    </tr>
                @endforeach
            </x-table>

            <tr class="border">
                <div class="mt-4 flex justify-start gap-3">
                    <a href="{{ route('users.edit', $user->id) }}">
                        <x-primary-button>Edit</x-primary-button>
                    </a>
                </div>
            </tr>
        </div>
    </div>
@endsection