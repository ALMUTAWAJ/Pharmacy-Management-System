@extends('layouts.admin-layout')

@section('admin-content')
    <!-- Admin report content -->
    {{-- Filter by Date --}}
    
    {{-- <form action="{{ route('admin.report') }}" method="get">
    <x-primary-button type="submit" id="submit-button">search</x-primary-button>
<div date-rangepicker class="flex items-center">
    <span class="mx-4 text-gray-500">From</span>
    <div class="relative">
      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
           <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
          </svg>
      </div>
      <input name="start" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
    </div>
    <span class="mx-4 text-gray-500">to</span>
    <div class="relative">
      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
           <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
          </svg>
      </div>
      <input name="end" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">
  </div>
  </div>
    </form> --}}
    {{-- <form action="{{ route('admin.report') }}" method="get">
        <x-primary-button type="submit" id="submit-button">search</x-primary-button>
        <div date-rangepicker class="flex items-center">
            <span class="mx-4 text-gray-500">From</span>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </div>
                <input name="start" type="datetime-local" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
            </div>
            <span class="mx-4 text-gray-500">to</span>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </div>
                <input name="end" type="datetime-local" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">
            </div>
        </div>
    </form> --}}
{{-- Summary --}}

<div class="grid grid-cols-2 gap-4 my-2">
    <div class="bg-white border border-gray-300 rounded-lg p-2">
        <div class="flex justify-center">
            <svg width="30px" height="30px" viewBox="0 0 1024 1024" fill="#000000" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M496 740.8v-52c-35.2-4-72.8-19.2-99.2-40.8l-3.2-2.4 25.6-32.8 3.2 2.4c29.6 23.2 59.2 34.4 89.6 34.4 42.4 0 65.6-18.4 65.6-52.8 0-40.8-37.6-57.6-76.8-75.2-44.8-20-90.4-40.8-90.4-96.8C410.4 379.2 444.8 344 496 336v-52.8h40.8v52c40 4.8 64.8 23.2 81.6 40l3.2 3.2-28.8 28.8-2.4-2.4c-21.6-19.2-39.2-28.8-71.2-28.8-34.4 0-57.6 19.2-57.6 48.8 0 33.6 32.8 48 70.4 64 45.6 20 97.6 41.6 97.6 107.2 0 50.4-35.2 85.6-92 93.6v52.8H496z" fill=""></path><path d="M512 928.8c-229.6 0-416.8-187.2-416.8-416.8 0-229.6 187.2-416.8 416.8-416.8 229.6 0 416.8 187.2 416.8 416.8 0 229.6-187.2 416.8-416.8 416.8z m0-791.2c-206.4 0-374.4 168-374.4 374.4 0 206.4 168 374.4 374.4 374.4 206.4 0 374.4-168 374.4-374.4 0-206.4-168-374.4-374.4-374.4z" fill=""></path><path d="M512 853.6c-12 0-21.6-9.6-21.6-21.6s9.6-21.6 21.6-21.6c164 0 297.6-133.6 297.6-297.6 0-45.6-10.4-89.6-30.4-130.4-2.4-5.6-3.2-11.2-0.8-16.8 1.6-5.6 5.6-9.6 11.2-12.8 3.2-1.6 6.4-2.4 9.6-2.4 8.8 0 16 4.8 19.2 12 23.2 47.2 34.4 96.8 34.4 149.6 0.8 188-152.8 341.6-340.8 341.6zM735.2 304.8c-5.6 0-11.2-2.4-15.2-6.4-56-54.4-129.6-84.8-208-84.8-12 0-21.6-9.6-21.6-21.6s9.6-21.6 21.6-21.6c89.6 0 174.4 34.4 238.4 96.8 4 4 6.4 9.6 6.4 15.2s-2.4 11.2-6.4 15.2c-4 4.8-9.6 7.2-15.2 7.2zM388 828c-3.2 0-5.6-0.8-8.8-1.6C252.8 772.8 170.4 649.6 170.4 512c0-132.8 78.4-255.2 199.2-310.4 3.2-1.6 5.6-1.6 8.8-1.6 8.8 0 16 4.8 20 12.8 4.8 11.2 0 24-10.4 28.8-105.6 48-173.6 154.4-173.6 270.4 0 120 71.2 228 182.4 274.4 5.6 2.4 9.6 6.4 12 12 2.4 5.6 2.4 11.2 0 16.8-4.8 8-12 12.8-20.8 12.8z" fill=""></path></g></svg>
        </div>
        <div>
            <p class="text-md text-indigo-500 font-bold text-center">BD {{$totalRevenue}}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600 text-center px-5">Total Revenue</p>
        </div>
    </div>
    <div class="bg-white border border-gray-300 rounded-lg p-2">
        <div class="flex justify-center">
            <svg width="30px" height="30px" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g clip-path="url(#clip0_14_1995)"> <path d="M27.865 31.758C33.5972 31.758 38.244 27.1112 38.244 21.379C38.244 15.6468 33.5972 11 27.865 11C22.1328 11 17.486 15.6468 17.486 21.379C17.486 27.1112 22.1328 31.758 27.865 31.758Z" stroke="#000000" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M40 36.346C37.0313 33.3973 33.0142 31.7466 28.83 31.756H26.9C22.6831 31.756 18.6388 33.4312 15.657 36.413C12.6752 39.3948 11 43.4391 11 47.656V52.516H44.73V51.756" stroke="#000000" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M48.621 38.146V46.123" stroke="#000000" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M52.609 42.134H44.632" stroke="#000000" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path> </g> <defs> <clipPath id="clip0_14_1995"> <rect width="45.609" height="45.516" fill="white" transform="translate(9 9)"></rect> </clipPath> </defs> </g></svg>
        </div>
        <div>  
            <p class="text-md text-indigo-500 font-bold text-center">{{$customers}}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600 text-center px-5">New customers</p>
        </div>
    </div>
    <div class="bg-white border border-gray-300 rounded-lg p-2">
        <div class="flex justify-center">
            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z" stroke="#1C274C" stroke-width="1.5"></path> <path d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z" stroke="#1C274C" stroke-width="1.5"></path> <path d="M11 10.8L12.1429 12L15 9" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M2 3L2.26121 3.09184C3.5628 3.54945 4.2136 3.77826 4.58584 4.32298C4.95808 4.86771 4.95808 5.59126 4.95808 7.03836V9.76C4.95808 12.7016 5.02132 13.6723 5.88772 14.5862C6.75412 15.5 8.14857 15.5 10.9375 15.5H12M16.2404 15.5C17.8014 15.5 18.5819 15.5 19.1336 15.0504C19.6853 14.6008 19.8429 13.8364 20.158 12.3075L20.6578 9.88275C21.0049 8.14369 21.1784 7.27417 20.7345 6.69708C20.2906 6.12 18.7738 6.12 17.0888 6.12H11.0235M4.95808 6.12H7" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
        </div>
        <div>
            <p class="text-md text-indigo-500 font-bold text-center">{{$orders}}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600 text-center px-5">New Orders</p>
        </div>
    </div>
    <div class="bg-white border border-gray-300 rounded-lg p-2"> 
        <div class="flex justify-center">
            <svg width="40px" height="40px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12.75 10.6C12.75 10.1858 12.4142 9.85 12 9.85C11.5858 9.85 11.25 10.1858 11.25 10.6H12.75ZM12 19H11.25C11.25 19.2489 11.3734 19.4815 11.5795 19.6211C11.7856 19.7606 12.0475 19.7888 12.2785 19.6964L12 19ZM19 16.2L19.2785 16.8964C19.5633 16.7825 19.75 16.5067 19.75 16.2H19ZM19.75 10.379C19.75 9.96479 19.4142 9.629 19 9.629C18.5858 9.629 18.25 9.96479 18.25 10.379H19.75ZM12.4538 10.0029C12.124 9.75224 11.6535 9.81641 11.4029 10.1462C11.1522 10.476 11.2164 10.9465 11.5462 11.1971L12.4538 10.0029ZM14.5 12.5L14.0462 13.0971C14.2687 13.2663 14.5669 13.2976 14.8198 13.1784L14.5 12.5ZM19.3198 11.0574C19.6944 10.8808 19.855 10.4339 19.6784 10.0592C19.5018 9.68456 19.0549 9.52398 18.6802 9.70058L19.3198 11.0574ZM11.7215 9.90364C11.3369 10.0575 11.1498 10.494 11.3036 10.8785C11.4575 11.2631 11.894 11.4502 12.2785 11.2964L11.7215 9.90364ZM19.2785 8.49636C19.6631 8.34252 19.8502 7.90604 19.6964 7.52146C19.5425 7.13687 19.106 6.94981 18.7215 7.10364L19.2785 8.49636ZM18.7215 8.49636C19.106 8.65019 19.5425 8.46313 19.6964 8.07854C19.8502 7.69396 19.6631 7.25748 19.2785 7.10364L18.7215 8.49636ZM12.2785 4.30364C11.894 4.14981 11.4575 4.33687 11.3036 4.72146C11.1498 5.10604 11.3369 5.54252 11.7215 5.69636L12.2785 4.30364ZM19.3665 7.14562C19.005 6.94323 18.548 7.07214 18.3456 7.43355C18.1432 7.79495 18.2721 8.25199 18.6335 8.45438L19.3665 7.14562ZM21.5 9.2L21.8199 9.87835C22.0739 9.75855 22.2397 9.50686 22.2495 9.22618C22.2593 8.94549 22.1115 8.68285 21.8665 8.54562L21.5 9.2ZM18.6801 9.70065C18.3054 9.87733 18.145 10.3243 18.3217 10.6989C18.4983 11.0736 18.9453 11.234 19.3199 11.0573L18.6801 9.70065ZM4.72146 7.10364C4.33687 7.25748 4.14981 7.69396 4.30364 8.07854C4.45748 8.46313 4.89396 8.65019 5.27854 8.49636L4.72146 7.10364ZM12.2785 5.69636C12.6631 5.54252 12.8502 5.10604 12.6964 4.72146C12.5425 4.33687 12.106 4.14981 11.7215 4.30364L12.2785 5.69636ZM5.36645 8.45438C5.72786 8.25199 5.85677 7.79495 5.65438 7.43355C5.45199 7.07214 4.99495 6.94323 4.63355 7.14562L5.36645 8.45438ZM2.5 9.2L2.13355 8.54562C1.8885 8.68285 1.74065 8.94549 1.75046 9.22618C1.76026 9.50686 1.92606 9.75855 2.18009 9.87835L2.5 9.2ZM4.68009 11.0573C5.05473 11.234 5.50167 11.0736 5.67835 10.6989C5.85503 10.3243 5.69455 9.87733 5.31991 9.70065L4.68009 11.0573ZM5.27854 7.10364C4.89396 6.94981 4.45748 7.13687 4.30364 7.52146C4.14981 7.90604 4.33687 8.34252 4.72146 8.49636L5.27854 7.10364ZM11.7215 11.2964C12.106 11.4502 12.5425 11.2631 12.6964 10.8785C12.8502 10.494 12.6631 10.0575 12.2785 9.90364L11.7215 11.2964ZM12.75 10.6C12.75 10.1858 12.4142 9.85 12 9.85C11.5858 9.85 11.25 10.1858 11.25 10.6H12.75ZM12 19L11.7215 19.6964C11.9525 19.7888 12.2144 19.7606 12.4205 19.6211C12.6266 19.4815 12.75 19.2489 12.75 19H12ZM5 16.2H4.25C4.25 16.5067 4.43671 16.7825 4.72146 16.8964L5 16.2ZM5.75 10.379C5.75 9.96479 5.41421 9.629 5 9.629C4.58579 9.629 4.25 9.96479 4.25 10.379H5.75ZM12.4538 11.1971C12.7836 10.9465 12.8478 10.476 12.5971 10.1462C12.3465 9.81641 11.876 9.75224 11.5462 10.0029L12.4538 11.1971ZM9.5 12.5L9.18024 13.1784C9.4331 13.2976 9.73125 13.2663 9.95381 13.0971L9.5 12.5ZM5.31976 9.70058C4.94508 9.52398 4.49818 9.68456 4.32158 10.0592C4.14498 10.4339 4.30556 10.8808 4.68024 11.0574L5.31976 9.70058ZM11.25 10.6V19H12.75V10.6H11.25ZM12.2785 19.6964L19.2785 16.8964L18.7215 15.5036L11.7215 18.3036L12.2785 19.6964ZM19.75 16.2V10.379H18.25V16.2H19.75ZM11.5462 11.1971L14.0462 13.0971L14.9538 11.9029L12.4538 10.0029L11.5462 11.1971ZM14.8198 13.1784L19.3198 11.0574L18.6802 9.70058L14.1802 11.8216L14.8198 13.1784ZM12.2785 11.2964L19.2785 8.49636L18.7215 7.10364L11.7215 9.90364L12.2785 11.2964ZM19.2785 7.10364L12.2785 4.30364L11.7215 5.69636L18.7215 8.49636L19.2785 7.10364ZM18.6335 8.45438L21.1335 9.85438L21.8665 8.54562L19.3665 7.14562L18.6335 8.45438ZM21.1801 8.52165L18.6801 9.70065L19.3199 11.0573L21.8199 9.87835L21.1801 8.52165ZM5.27854 8.49636L12.2785 5.69636L11.7215 4.30364L4.72146 7.10364L5.27854 8.49636ZM4.63355 7.14562L2.13355 8.54562L2.86645 9.85438L5.36645 8.45438L4.63355 7.14562ZM2.18009 9.87835L4.68009 11.0573L5.31991 9.70065L2.81991 8.52165L2.18009 9.87835ZM4.72146 8.49636L11.7215 11.2964L12.2785 9.90364L5.27854 7.10364L4.72146 8.49636ZM11.25 10.6V19H12.75V10.6H11.25ZM12.2785 18.3036L5.27854 15.5036L4.72146 16.8964L11.7215 19.6964L12.2785 18.3036ZM5.75 16.2V10.379H4.25V16.2H5.75ZM11.5462 10.0029L9.04619 11.9029L9.95381 13.0971L12.4538 11.1971L11.5462 10.0029ZM9.81976 11.8216L5.31976 9.70058L4.68024 11.0574L9.18024 13.1784L9.81976 11.8216Z" fill="#000000"></path> </g></svg>
        </div>
        <div>
            <p class="text-md text-indigo-500 font-bold text-center">{{$itemsSold}}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600 text-center px-5">Items Sold</p>
        </div>
        <div>

        </div>
    </div>
</div>

  {{-- Height rating & chart --}}
  <div class="grid grid-cols-5 gap-2 border p-3">
    {{-- <div class="grid grid-cols-3 gap-4 mt-6 border border-blue-500"> --}}
      <!--Height rating -->
       <div class="col-span-2 md:grid-cols-5 border border-gray-300 bg-white rounded-lg p-2 shadow-sm">
              <!-- component -->
              {{-- the input for choosing how many product admin wants to see --}}
              <div class="grid grid-cols-3">
                  <label for="number" class="col-span-2 mb-2 text-sm font-medium text-gray-600 dark:text-white">Most Recent Products</label>
                  {{-- <input type="number" id="choose-number" class="col-span-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required> --}}
              </div>
             
      <div x-data="imageSlider" class="relative mx-auto max-w-2xl overflow-hidden rounded-md bg-gray-100 p-2 sm:p-4">
          <div class="absolute right-5 top-5 z-10 rounded-full bg-gray-500 px-2 text-center text-sm text-white">
              <span x-text="currentIndex"></span>/<span x-text="images.length"></span>
          </div>
  
          <button @click="previous()" class="absolute left-5 top-1/2 z-10 flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full bg-gray-100 shadow-md">
              <i class="fas fa-chevron-left text-2xl font-bold text-gray-500"></i>
          </button>
  
          <button @click="forward()" class="absolute right-5 top-1/2 z-10 flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full bg-gray-100 shadow-md">
              <i class="fas fa-chevron-right text-2xl font-bold text-gray-500"></i>
          </button>
  
          <div class="relative h-80" style="width: 30rem items-center justify-center">
              <template x-for="(image, index) in images">
                  <div class="flex border bg-white items-center justify-center " x-show="currentIndex == index + 1" x-transition:enter="transition transform duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition transform duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute top-0">
                      <img :src="image" alt="image" class="justify-center" />
                  </div>
              </template>
           </div>
          </div>
          <div class="flex justify-between mt-2">
              <div class="content">
                <!-- Your content fore the model details -->
              </div>
              <div class="btn">
                  <button class="bg-transparent  text-gray-500 font-normal underline hover:text-black py-2 px-4  hover:border-transparent rounded">
                      Full details
                    </button>
              </div>
            </div>
  
      </div> 
  
            <!-- component -->
      <!--chart start-->
      <div class="relative flex justify-center items-center w-auto chart col-span-3 border md:grid-cols-5 border-gray-300 bg-white border-sm rounded-lg">
          {{-- <ul class="numbers">
              <li><span>100%</span></li>
              <li><span>50%</span></li>
              <li><span>0%</span></li>
          </ul> --}}
          {{-- you need to chenge this show it only if there are data, so make a loop --}}
          <label for="categoryPercentage" class="col-span-2 p-7 text-sm font-medium text-gray-600 dark:text-white">% Percentage of Revenue by Category</label>
          <div class="flex justify-center items-center absolute bottom-0 mx-auto right-0 left-0 top-0 justify-end">
          <ul class="bars m-4 border " >
              @for ($i = 0; $i < count($categoryRevenuePercentage); $i++)
              <li class="flex items-center justify-center">
                  <div class="bar mb-1" data-percentage="{{number_format($categoryRevenuePercentage[$i]->percentage, 1)}}"></div>
                  <span class="ml-6">{{$categoryRevenuePercentage[$i]->category}}
                  </li>
              <li>
              @endfor
          </ul>
          </div>
         
      </div>
      <!--chart end-->
    </div>
  {{------------ SCRIPT ------------}}
       <!--  srart slider script -->
       <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("imageSlider", () => ({
                currentIndex: 1,
                images: [
                    @foreach ($heighImageNames as $imageName)
                        '/images/{{ $imageName }}',
                    @endforeach
                ],
                previous() {
                    if (this.currentIndex > 1) {
                        this.currentIndex = this.currentIndex - 1;
                    }
                },
                forward() {
                    if (this.currentIndex < this.images.length) {
                        this.currentIndex = this.currentIndex + 1;
                    }
                },
            }));
        });
    </script>
    <!--  end slider script -->
  
      <!--  srart chart script -->
      <script type="text/javascript">
          $(function() {
              $('.bars li .bar').each(function(key, bar) {
                  var percentage = $(this).data('percentage');
                  $(this).animate({
                      'height': percentage + '%'
                  }, 1000);
              });
          });
      </script>
  
  
      <!--  end chart script --> 
    </div>


  @endsection