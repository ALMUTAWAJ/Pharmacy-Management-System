@php
    // $chat_route = config('chatify.routes.prefix');
    //    $links = ["Customers Requests(not yet)"=>'admin.add.product',"Manage Discounts(not yet)"=>'admin.add.product',"Manage Products"=>'admin.view.product', 'Manage Orders'=>'admin.view.order', 'Customer Messages'=>"$chat_route"];
@endphp

@extends('main')
<x-navigation.sidebar-admin>

</x-navigation.sidebar-admin>


@section('content')
    <!-- Additional customer-specific content -->
    {{-- <div class="admin-content border border-orange-400">
        @yield('admin-content')
    </div> --}}
    <div class="admin-content p-4 sm:ml-64 border bordeer border-green-600">
        <div class="p-4 border-2 border-red-400 border-dashed rounded-lg dark:border-gray-700">
            {{-- <div class="flex items-center justify-center h-48 mb-4 rounded bg-red-50 dark:bg-gray-500"> --}}
            {{-- <p class="text-2xl text-gray-400 dark:text-gray-500"> --}}
            @yield('admin-content')
            {{-- </p> --}}
            {{-- </div> --}}
        </div>
    </div>
@endsection

@section('footer')
    @include('components.navigation.footer')
@endsection
