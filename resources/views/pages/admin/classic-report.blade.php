@extends('layouts.admin-layout')

@section('admin-content')
    <section class="bg-white ">
        <div class="flex justify-end">
            <x-primary-button id="print">
                <svg fill="#ffffff" width="25px" height="25px" viewBox="0 0 32 32" version="1.1"
                    xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <title>print</title>
                        <path
                            d="M30 14.25h-3.25v-8.25c0-0 0-0.001 0-0.001 0-0.206-0.084-0.393-0.219-0.529v0l-4-4c-0.136-0.136-0.324-0.22-0.531-0.22-0 0-0 0-0 0h-17c-0.414 0-0.75 0.336-0.75 0.75v0 12.25h-2.25c-0.414 0-0.75 0.336-0.75 0.75v0 9c0 0.414 0.336 0.75 0.75 0.75s0.75-0.336 0.75-0.75v0-8.25h26.5v8.25c0 0.414 0.336 0.75 0.75 0.75s0.75-0.336 0.75-0.75v0-9c-0-0.414-0.336-0.75-0.75-0.75v0zM5.75 2.75h15.939l3.561 3.561v7.939h-19.5zM26 21.25h-20c-0.414 0-0.75 0.336-0.75 0.75v0 8c0 0.414 0.336 0.75 0.75 0.75h20c0.414-0 0.75-0.336 0.75-0.75v0-8c-0-0.414-0.336-0.75-0.75-0.75v0zM25.25 29.25h-18.5v-6.5h18.5zM26.279 19.199c0.178-0.099 0.322-0.242 0.417-0.415l0.003-0.005c0.027-0.067 0.043-0.145 0.043-0.227 0-0.018-0.001-0.037-0.002-0.054l0 0.002c-0.004-0.21-0.087-0.399-0.221-0.54l0 0c-0.142-0.122-0.327-0.196-0.53-0.196s-0.389 0.074-0.531 0.196l0.001-0.001c-0.122 0.145-0.197 0.334-0.199 0.54v0c-0.001 0.011-0.001 0.024-0.001 0.037 0 0.189 0.077 0.359 0.2 0.483v0c0.132 0.136 0.317 0.221 0.521 0.221 0.007 0 0.014-0 0.021-0l-0.001 0c0.016 0.001 0.034 0.002 0.052 0.002 0.082 0 0.16-0.016 0.231-0.045l-0.004 0.001z">
                        </path>
                    </g>
                </svg>
                print
            </x-primary-button>
        </div>
        <div class="grid grid-cols-4 gap-4">
            <div class="col-span-3">
                <x-search-bar placeholder="Search by name or description" name="search" :value="request('search')" />
            </div>
            <div class="col-span-1 ">

                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                    class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800"
                    type="button">Table <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdown"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="{{ route('admin.classic-report', 'users') }}"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">users</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.classic-report', 'products') }}"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">products</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.classic-report', 'orders') }}"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">orders</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.classic-report', 'suppliers') }}"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">suppliers</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.classic-report', 'payments') }}"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">payments</a>
                        </li>
                    </ul>
                </div>


            </div>

        </div>

{{--  --}}
<div class="content">
    @if ($users->isNotEmpty())
    {{-- table start --}}
        <div id="printableArea" class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table  class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        @foreach($columns as $value)
                        <th scope="col" class="px-6 py-3">
                            {{ $value }}
                            {{-- <a href="{{ route('admin.classic-report', ['table' => $model->getTable(), 'column' => $columns]) }}">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path opacity="0.5" d="M16 18L16 6M16 6L20 10.125M16 6L12 10.125" stroke="#919191"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M8 6L8 18M8 18L12 13.875M8 18L4 13.875" stroke="#919191" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                            </a> --}}
                            
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        @foreach($columns as $column)
                        <td class="px-6 py-4">{{ $user->$column }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@else
</div>


<x-title scope="col" colspan="3" class="px-6 py-3">Data not found</x-title>
@endif
        {{-- end of table --}}

        {{-- paggintion --}}
        {{-- <div class="mt-4">
            <div class="flex flex-col items-center">
                <!-- Help text -->
                <span class="text-sm text-gray-700 dark:text-gray-400">
                    Showing <span class="font-semibold text-gray-900 dark:text-white"></span> to <span
                        class="font-semibold text-gray-900 dark:text-white">10</span> of <span
                        class="font-semibold text-gray-900 dark:text-white">100</span> Entries
                </span>
                <!-- Buttons -->
                <div class="inline-flex mt-2 xs:mt-0">
                    <button
                        class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        Prev
                    </button>
                    <button
                        class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        Next
                    </button>
                </div>
            </div>
        </div> --}}

        {{-- <div class="mt-4">
            <div class="flex flex-col items-center">
                <!-- Help text -->
                <span class="text-sm text-gray-700 dark:text-gray-400">
                    Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $users->firstItem() }}</span> to <span class="font-semibold text-gray-900 dark:text-white">{{ $users->lastItem() }}</span> of <span class="font-semibold text-gray-900 dark:text-white">{{ $users->total() }}</span> Entries
                </span>
                <!-- Buttons -->
                <div class="inline-flex mt-2 xs:mt-0">
                    @if ($users->onFirstPage())
                        <!-- Disable the "Previous" button when on the first page -->
                        <button
                            class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-s dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 cursor-not-allowed"
                            disabled>
                            Prev
                        </button>
                    @else
                        <!-- Enable the "Previous" button with the appropriate URL for the previous page -->
                        <a href="{{ $users->previousPageUrl() }}"
                            class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            Prev
                        </a>
                    @endif
        
                    @if ($users->hasMorePages())
                        <!-- Enable the "Next" button with the appropriate URL for the next page -->
                        <a href="{{ $users->nextPageUrl() }}"
                            class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            Next
                        </a>
                    @else
                        <!-- Disable the "Next" button when on the last page -->
                        <button
                            class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 cursor-not-allowed"
                            disabled>
                            Next
                        </button>
                    @endif
                </div>
            </div>
        </div> --}}
        <div class="mt-4">
            <div class="flex flex-col items-center">
                <!-- Help text -->
                <span class="text-sm text-gray-700 dark:text-gray-400">
                    Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $users->firstItem() }}</span> to <span class="font-semibold text-gray-900 dark:text-white">{{ $users->lastItem() }}</span> of <span class="font-semibold text-gray-900 dark:text-white">{{ $users->total() }}</span> Entries
                </span>
                <!-- Buttons -->
                <div class="inline-flex mt-2 xs:mt-0">
                    @if ($users->onFirstPage())
                        <!-- Disable the "Previous" button when on the first page -->
                        <button
                            class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-s dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 cursor-not-allowed"
                            disabled>
                            Prev
                        </button>
                    @else
                        <!-- Enable the "Previous" button with the appropriate URL for the previous page -->
                        <a href="{{ $users->previousPageUrl() }}"
                            class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            Prev
                        </a>
                    @endif
        
                    @if ($users->hasMorePages())
                        <!-- Enable the "Next" button with the appropriate URL for the next page -->
                        <a href="{{ $users->nextPageUrl() }}"
                            class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            Next
                        </a>
                    @else
                        <!-- Disable the "Next" button when on the last page -->
                        <button
                            class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 cursor-not-allowed"
                            disabled>
                            Next
                        </button>
                    @endif
                </div>
            </div>
        </div>



    </section>
@endsection

