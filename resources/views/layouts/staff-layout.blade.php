@php
    // $chat_route = config('chatify.routes.prefix');
    //    $links = ["Customers Requests(not yet)"=>'staff.add.product',"Manage Discounts(not yet)"=>'staff.add.product',"Manage Products"=>'staff.view.product', 'Manage Orders'=>'staff.view.order', 'Customer Messages'=>"$chat_route"];
@endphp

@extends('main')
<x-navigation.sidebar-staff>

</x-navigation.sidebar-staff>


@section('content')
    <!-- Additional customer-specific content -->
    {{-- <div class="staff-content border border-orange-400">
        @yield('staff-content')
    </div> --}}
    <div class="staff-content p-4 sm:ml-64 border bordeer border-green-600">
        <div class="p-4 border-2 border-red-400 border-dashed rounded-lg dark:border-gray-700">
            {{-- <div class="flex items-center justify-center h-48 mb-4 rounded bg-red-50 dark:bg-gray-500"> --}}
            {{-- <p class="text-2xl text-gray-400 dark:text-gray-500"> --}}
            @yield('staff-content')
            {{-- </p> --}}
            {{-- </div> --}}
        </div>
    </div>
@endsection

@section('footer')
    @include('components.navigation.footer')
@endsection
