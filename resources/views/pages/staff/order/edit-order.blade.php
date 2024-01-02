@extends('layouts.staff-layout')

@section('staff-content')
    <section class="bg-white">
        <div class="py-8 px-6 mx-auto max-w-2xl lg:py-16 rounded-md">
            <a href="{{route('staff.view.order')}}">
                <x-prev-button>Back</x-prev-button><br><br>
            </a>
            <x-success-message></x-success-message>
            <x-fail-message></x-fail-message>
            <x-errors></x-errors>
            
            @php

               $disabled = $order->status === 'Cancelled' || $order->status === 'Delivered';
                
            @endphp

            <form method="GET" action="{{ route('staff.edit.order', ['id' => $order->id])  }}">
                @csrf
                <div class="grid grid-cols-4 gap-4">
                    <!-- Search bar -->
                    <div class="col-span-3">
                        <x-search-bar placeholder="Search by order name or ID" name="search" :value="request('search')" />
                    </div>
                    <!-- Dropdown -->
                    <div class="col-span-1">
                        <x-dropdown-input
                            triggerText="{{ ucfirst(request('filter_type') == null ? 'All' : request('filter_type')) }}">
                            <div class="cursor-pointer hover:bg-gray-100 p-2" onclick="selectFilter('')">All</div>
                            <div class="cursor-pointer hover:bg-gray-100 p-2" onclick="selectFilter('Beauty')">Beauty</div>
                            <div class="cursor-pointer hover:bg-gray-100 p-2" onclick="selectFilter('Baby Care')">Baby Care
                            </div>
                            <div class="cursor-pointer hover:bg-gray-100 p-2" onclick="selectFilter('Medicine')">Medicine
                            </div>
                            <div class="cursor-pointer hover:bg-gray-100 p-2" onclick="selectFilter('Personal Care')">
                                Personal Care</div>
                        </x-dropdown-input>
                        <input type="hidden" id="filter_type" name="filter_type" value="{{ request('filter_type') }}" />
                    </div>
                </div>
            </form>
            
            <br>
            <br>

            <div class="bg-white-500 text-purple-100 p-4 rounded-lg shadow-lg mb-8">
                <p class="text-2xl text-gray-600 font-bold mb-4">Order Brief</p>
                <div class="flex flex-wrap gap-2">
                    <div class="bg-gray-100 text-purple-900 px-2 py-1 rounded-md">Order ID: {{ $order->id }}</div>
                    <div class="bg-gray-100 text-purple-900 px-2 py-1 rounded-md">Order Status: {{ $order->status }}</div>
                    <div class="bg-gray-100 text-purple-900 px-2 py-1 rounded-md">Total Price: BD{{ $order->total_price }}</div>
                    <div class="bg-gray-100 text-purple-900 px-2 py-1 rounded-md">Customer Name: @if($personal) {{ $personal->firstname }} {{ $personal->lastname }} @else N/A @endif</div>
                    <div class="bg-gray-100 text-purple-900 px-2 py-1 rounded-md">Ordered At: {{ $order->created_at }}</div>
                    <div class="bg-gray-100 text-purple-900 px-2 py-1 rounded-md">Last Updated: {{ $order->updated_at }}</div>

                </div>
            </div>

            
            {{-- Edit from here check the design and whatever fields to be put here and make the cols as input fields --}}

            <form action="{{route('staff.order.updateGeneral',['id'=>$order->id])}}" method="post">
                @csrf
                @method('PUT')

                <div>
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                    <select name="status" required id="status" {{ $disabled ? 'disabled' : '' }}
                        class="bg-gray-100 border border-gray-300 text-gray-500 text-sm rounded-lg focus:border-purple-500 block w-full p-2.5 border-2 border-solid"
                        {{ $disabled ? 'aria-disabled="true"' : '' }}>
                        <option value='' >Select a status</option>
                        <option {{ $disabled ? 'disabled' : '' }} value='Cancelled' {{$order->status=='Cancelled'?'Selected':''}}>Cancelled</option>
                        <option value="Pending" {{ old('status', $order->status) === 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="In Progress" {{ old('status', $order->status) === 'In progress' ? 'selected' : '' }}>In progress</option>
                        <option value="Delivered" {{ old('status', $order->status) === 'Delivered' ? 'selected' : '' }}>Delivered</option>
                    </select>
                </div>
                
                <br><br>

            <!-- Prescription Files -->
            @if ($prescriptionFiles->isNotEmpty())

                <h2 class="text-2xl font-bold mb-4">Prescription Files</h2>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-6">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                      <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                          <th scope="col" class="w-10/12 px-10 py-3">Prescription Link</th>
                          <th scope="col" class="w-2/12 px-4 py-3 text-right pr-5">Approval</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($prescriptionFiles as $index => $prescription)
                          <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }} border-b">
                            <td class="w-10/12 px-10 py-3">
                           <u>   <a href="{{ asset('storage/' . $prescription->prescription_upload) }}" target="_blank">
                                Prescription {{ $index + 1 }}
                              </a>
                            </u>
                            </td>
                            <td class="w-2/12 px-4 py-3 text-right pr-10">
                              <input type="checkbox" name="approval[]" value="{{ $prescription->id }}" {{ $prescription->approval ? 'checked' : '' }}>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
            @endif           

            <h2 class="text-2xl font-bold mb-4 mt-3">Order Products</h2>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-70 text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-10 py-3">
                                Image
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Product ID
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Product Name
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Unit Price (BD)
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Quantity
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        @foreach ($orderDetails as $order_detail)
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <td class="p-2">
                                    <img src="{{asset('storage/'.$order_detail->product->image)}}" 
                                        class="w-10 md:w-20 max-w-full max-h-full" alt="Product Image">
                                </td>
                                <th scope="row" class="text-center px-2 py-2 font-medium text-gray-900 whitespace-nowrap">
                                    {{$order_detail->product->id}}
                                </th>
                                <td class="px-2 py-2 text-center">
                                    {{$order_detail->product->name}}
                                </td>
                                <td class="text-center px-2 py-2">
                                    {{"BD".$order_detail->product->price}}
                                </td>
                                <td class="px-2 py-2">
                                    <div class="flex items-center">
                                        <button onclick="decreaseQuantity(this)"
                                            class="inline-flex items-center justify-center p-1 me-2 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200"
                                            type="button">
                                            <span class="sr-only">Decrease Quantity button</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 18 2">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M1 1h16" />
                                            </svg>
                                        </button>
                                    <div> 
                                            <input onchange="validateQuantities()" name='quantity[{{$order_detail->id}}]' min=0 max=30 onchange="validateQuantity(this)" type="number"
                                                class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2 py-1"
                                                value="{{$order_detail->quantity}}" > 
                                        </div>
                                        <button onclick="increaseQuantity(this)"
                                            class="inline-flex items-center justify-center h-6 w-6 p-1 ms-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200"
                                            type="button">
                                            <span class="sr-only">Increase Quantity button</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 18 18">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M9 1v16M1 9h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if (!isset($orderDetails)||count($orderDetails)==0)
            <br>
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                  <span class="font-medium">Empty, no details there !</span>
                </div>
              </div>
            @endif

            <x-submit-button :disabled="$disabled">
                Update Order
            </x-submit-button>
            

        </form>

        </div>
    </section>

    
    <script src="{{ asset('js/order.js') }}"></script>
@endsection
