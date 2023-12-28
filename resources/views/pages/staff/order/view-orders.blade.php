@extends('layouts.staff-layout')

@section('staff-content')
    <section class="bg-white">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16  rounded-md">
            <x-success-message></x-success-message>
            <x-fail-message></x-fail-message>

            <form method="GET" action="{{ route('staff.view.order') }}">
                @csrf
                <div class="grid grid-cols-4 gap-4">
                    <!-- Search bar -->
                    <div class="col-span-3">
                        <x-search-bar placeholder="Search by ID or Amount" name="search"
                            :value="request('search')" />
                    </div>
                    <!-- Dropdown -->
                    <div class="col-span-1">
                        <x-dropdown-input triggerText="{{ ucfirst(request('filter_type')==null ? 'All':request('filter_type')) }}">
                            <div class="cursor-pointer hover:bg-gray-100 p-2" onclick="selectFilter('')">All</div>
                            <div class="cursor-pointer hover:bg-gray-100 p-2" onclick="selectFilter('Pending')">Pending</div>
                            <div class="cursor-pointer hover:bg-gray-100 p-2" onclick="selectFilter('In Progress')">In Progress</div>
                            <div class="cursor-pointer hover:bg-gray-100 p-2" onclick="selectFilter('Delivered')">Delivered</div>
                            <div class="cursor-pointer hover:bg-gray-100 p-2" onclick="selectFilter('Cancelled')">Cancelled</div>
                        </x-dropdown-input>
                        <input type="hidden" id="filter_type" name="filter_type" value="{{ request('filter_type') }}" />
                    </div>
                </div>
            </form>
            <br>
            <!-- display data -->
            <x-table>
                <tr>
                <x-slot name="header">
                    <x-table-col>Order ID</x-table-col>
                    <x-table-col>Amount (BD)</x-table-col>
                    <x-table-col>Status</x-table-col>
                    <x-table-col>Order Date</x-table-col>
                    <x-table-col>Updated At</x-table-col>
                    <x-table-col>Actions</x-table-col>
                </x-slot>
            </tr>
            <br>
                @if (($searchQuery||$filter!=null) && $orders->isEmpty())
                    <tr>
                            <div class="flex items-center p-4 mb-4 text-sm text-red-500 rounded-lg bg-purple-50"
                                role="alert">
                                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <span class="sr-only">Info</span>
                                <div>
                                    <span class="font-medium">&nbsp; No Orders Found.</span>
                                </div>
                            </div>
                    </tr>

                @else
                @if ($orders->isEmpty()&&(!$searchQuery))
                <div>
                    <div class="flex items-center p-4 mb-4 text-sm text-red-500 rounded-lg bg-purple-50"
                                role="alert">
                                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <span class="sr-only">Info</span>
                                <div>
                                    <span class="font-medium">&nbsp; No Orders Found.</span>
                                </div>
                            </div>
                </div>
                   @else 
                @foreach ($orders as $order)
                <tr class="border">
                    <x-table-col>{{ $order->id }}</x-table-col>
                            <x-table-col>{{ number_format($order->total_price, 2) ." BD" }}</x-table-col>
                            <x-table-col>{{ $order->status }}</x-table-col>
                            <x-table-col>{{ $order->created_at }}</x-table-col>
                            <x-table-col>{{ $order->updated_at }}</x-table-col>
                            <x-table-col>
                                <form action="{{route('staff.order.update',$order->id)}}" method="POST"
                                    onsubmit="showDeleteConfirmation(event);">
                                    <a href="{{route('staff.edit.order',$order->id)}}">
                                        <x-secondary-button>
                                            {{ __('More') }}
                                        </x-secondary-button>
                                    </a>
                                    @csrf
                                    @method('PUT')
                                    <x-delete-button type="submit" class="btn">Cancel</x-delete-button>
                                </form>
                            </x-table-col>
                        </tr>
                        @endforeach
                        @endif
                    @endif
                </x-table>

            </form>
        </div>
    </section>


 
<script src="{{ asset('js/order.js') }}"></script>

@endsection
