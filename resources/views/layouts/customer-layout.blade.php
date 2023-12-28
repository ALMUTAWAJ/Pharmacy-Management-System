@extends('main')
@include('components.navigation.top-nav')


@section('content')
    <!-- Additional customer-specific content -->
    <div class="customer-content m-2">
        @yield('customer-content')
    </div>
@endsection
@section('footer')
    @include('components.navigation.footer')
@endsection
