@extends('layouts.admin-layout')

@section('admin-content')
    <section class="bg-white">
        <div class="py-8 px-4 mx-auto w-full lg:py-16  rounded-md">
            <x-success-message></x-success-message>
            <x-fail-message></x-fail-message>

            <form method="GET" action="{{ route('admin.view.stock_requests') }}">
                @csrf
                <button type="submit" name="sort" value="asc"
                    class="px-4 py-2 mr-4 bg-purple-500 text-white rounded-md hover:bg-blue-600">
                    Sort Ascending
                </button>
                <button type="submit" name="sort" value="desc"
                    class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                    Sort Descending
                </button>
            </form>
            <br>
            <!-- Display data for stock requests -->
            <x-table>
                <tr>
                    <x-slot name="header">
                        <x-table-col>Request ID</x-table-col>
                        <x-table-col>Product Name</x-table-col>
                        <x-table-col>Staff Member Name</x-table-col>
                        <x-table-col>Company Name</x-table-col>
                        <x-table-col>Request Date</x-table-col>
                        <x-table-col>Actions</x-table-col>
                    </x-slot>
                </tr>
                <br>
                <!-- Loop through stock requests -->
                @if ($stockRequests->isEmpty())
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
                            <span class="font-medium">&nbsp; No Stock Requests Found.</span>
                        </div>
                    </div>
            </tr>

                @else
                    <!-- Display stock request information -->
                    @foreach ($stockRequests as $request)
                        <tr class="border">
                            <x-table-col>{{ $request->id }}</x-table-col>
                            <x-table-col>{{  $request->product->name  }}</x-table-col>
                            <x-table-col>{{  $request->staff->name  }}</x-table-col>
                            <x-table-col>{{  $request->supplier->company_name }}</x-table-col>
                            <x-table-col>{{ $request->created_at }}</x-table-col>
                            <x-table-col>
                                
                                    <!-- Update this button to show more details about the request -->
                                    <a href="{{ route('admin.view.stock_request_detail', $request->id) }}">
                                        <x-secondary-button>
                                            {{ __('More') }}
                                        </x-secondary-button>
                                    </a>
                                 
                            </x-table-col>
                        </tr>
                    @endforeach
                @endif
            </x-table>

        </div>
    </section>


@endsection
