@extends('layouts.customer-layout')

@section('customer-content')





    {{-- welcome --}}
    <div class="text-center p-4 mt-4 mb-8">

        <div style="width: 67rem; margin-left: 12rem;">
            <form method="GET" action="{{ route('customer.products.index') }}">
                @csrf
                <div class="grid grid-cols-4 gap-4">
                    <!-- Search bar -->
                    <div class="col-span-3">
                        <x-search-bar placeholder="Search by name or description" name="search" :value="request('search')" />
                    </div>
                </div>
            </form>
        </div>
        
<br>

        <p class="text-5xl text-gray-900 dark:text-white">Welcome</p>
        <p class="text-2xl text-gray-900 dark:text-white">Welcome to our trusted online pharmacy, where your health and
            well-being are our top priority</p>
    </div>
    {{-- end welcome --}}


    {{-- carousel --}}

    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96 border-4">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="/images/slider/1.jpeg" style="width:500px;height:500px;" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                    alt="...">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="/images/slider/2.jpg"  style="width:500px;height:500px;" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                    alt="...">
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="/images/slider/3.jpg" style="width:500px;height:500px;" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                    alt="...">
            </div>
            <!-- Item 4 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="/images/slider/4.jpg"  style="width:500px;height:500px;" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                    alt="...">
            </div>
            <!-- Item 5 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="/images/soko.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                    alt="...">
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4"
                data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5"
                data-carousel-slide-to="4"></button>
        </div>
        <!-- Slider controls -->
        <button type="button"
            class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button"
            class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-next>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

    {{-- end carousel --}}




    {{-- products card --}}

    {{-- new Arrivals --}}
    @if (isset($newArrivals))
        <x-title>{{ __('new Arrivals') }}</x-title>
        <!-- component -->
        <div class="flex flex-col bg-white m-auto p-auto">
            <div class="flex overflow-x-scroll pb-10 hide-scroll-bar">
                <div class="flex flex-nowrap">
                    @for ($i = 0; $i < 7 && $i < count($newArrivals); $i++)
                        <div class="inline-block px-3">
                            <x-card id="{{ $newArrivals[$i]->id }}" image="{{ $newArrivals[$i]->image }}"
                                name="{{ $newArrivals[$i]->name }}"
                                description="{{ Str::limit($newArrivals[$i]->description, 60) }}"
                                price="{{ $newArrivals[$i]->price }}"
                                rate="{{ number_format($newArrivals[$i]->average_rating, 1) }}" />
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    @endif

    {{-- Best sellers --}}
    @if (isset ($bestSellers))
        <x-title>{{ __('Best sellers') }}</x-title>
        <!-- component -->
        <div class="flex flex-col bg-white m-auto p-auto">
            <div class="flex overflow-x-scroll pb-10 hide-scroll-bar">
                <div class="flex flex-nowrap">
                    @for ($i = 0; $i < 7 && $i < count($bestSellers); $i++)
                        <div class="inline-block px-3">
                            <x-card id="{{ $bestSellers[$i]->id }}" image="{{ $bestSellers[$i]->image }}"
                                name="{{ $bestSellers[$i]->name }}"
                                description="{{ Str::limit($bestSellers[$i]->description, 60) }}"
                                price="{{ $bestSellers[$i]->price }}"
                                rate="{{ number_format($bestSellers[$i]->average_rating, 1) }}" />
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    @endif

    <style>
        .hide-scroll-bar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .hide-scroll-bar::-webkit-scrollbar {
            display: none;
        }
    </style>

@endsection
