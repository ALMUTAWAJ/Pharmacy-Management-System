Users blade
@extends('layouts.admin-layout')

@section('admin-content')
    <x-success-message></x-success-message>
    <x-fail-message></x-fail-message>
    <!-- Admin dashboard content -->
    <div class="flex items-center justify-end mt-2">
        <a href="{{ route('admin.add.supplier') }}">
            <x-primary-button href="route">
                <span class="material-symbols-outlined">
                    add_circle
                </span>
                Add Supplier
            </x-primary-button>
        </a>
    </div>

    <form method="GET" action="{{ route('admin.view.supplier') }}">
        @csrf
        <div class="grid grid-cols-4 gap-4">
            <!-- Search bar -->
            <div class="col-span-3">
                <x-search-bar placeholder="Search by commerical register or company name" name="search" :value="request('search')" />
            </div>
        </div>
    </form>

    <br>
    <!-- display data -->
    <x-table style="color:black;">
        <x-slot name="header">
            <x-table-col>ID</x-table-col>
            <x-table-col>COMPANY NAME</x-table-col>
            <x-table-col>COMMERCIAL REGISTER</x-table-col>
            <x-table-col>PHONE NUMBER</x-table-col>
        </x-slot>

        @if ($searchQuery && $suppliers->isEmpty())
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
                    <span class="font-medium">&nbsp; No Products Found.</span>
                </div>
            </div>
    </tr>
        @else
            @foreach ($suppliers as $supplier)
                <tr class="border">
                    <x-table-col>{{ $supplier->id }}</x-table-col>
                    <x-table-col>{{ $supplier->company_name }}</x-table-col>
                    <x-table-col>{{ $supplier->commercial_register }}</x-table-col>
                    <x-table-col>{{ $supplier->phone }}</x-table-col>
                    <x-table-col>
                        <form action="{{ route('admin.delete.supplier', $supplier->id) }}" method="POST" onsubmit="showDeleteConfirmation(event);">
                            <a href="{{ route('admin.edit.supplier', ['id' => $supplier->id]) }}">
                                <x-secondary-button>
                                    {{ __('More') }}
                                </x-secondary-button>
                            </a>
                            @csrf
                            @method('PUT')
                            <x-delete-button type="submit" class="btn">Delete</x-delete-button>
                        </form>
                    </x-table-col>
                </tr>
            @endforeach
        @endif
    </x-table>

    <script src={{asset('js/product.js')}}></script>
@endsection
