@extends('layouts.customer-layout')

@section('customer-content')
<div class="container mx-auto mt-2">
        <div class="max-w-5xl mx-auto py-7 flex justify-end">
            <x-secondary-button onclick="window.print()">Print Invoice</x-secondary-button>
        </div>
        <div id="printable-content">
        <div class="max-w-5xl mx-auto py-16 bg-white border border-gray-300 mt-1">
        <article class="overflow-hidden">
        <div class="bg-[white] rounded-b-md">
        <div class="p-9">
            <div class="space-y-6 text-slate-700">
            <x-application-logo></x-application-logo>
            <p class="text-xl font-extrabold tracking-tight uppercase font-body">
            Order # {{ $order }} 

            @php
            $orderModel = \App\Models\Order::find($order);
            $customerID = $orderModel->customerID;
            $userModel = \App\Models\User::find($customerID);
            
            $phone = $userModel->phone_number;
            $email = $userModel->email;
            $personal = $userModel->personal;
            $firstname = $personal->firstname;
            $lastname = $personal->lastname;
            $addressId = $orderModel->addressID;
            $address = \App\Models\Address::find($addressId);
            $city = $address->city;
            $road = $address->road;
            $block = $address->block;
            $house = $address->house;
        
            $date = $orderModel->created_at->format('Y-m-d');
            $order_status = $orderModel->status;

        
            $total_price = $orderModel->total_price;
        @endphp
            
            </div>
        </div>
        <div class="p-9">
            <div class="flex w-full">
            <div class="grid grid-cols-4 gap-12">
            <div class="text-sm font-light text-slate-500">
            <p class="text-sm font-normal text-slate-700">
                Customer Details
            </p>
            <p>{{ $firstname }} {{ $lastname }}</p>
            <p>{{ $phone }}</p>
            <p>{{ $email }}</p>
            </div>
            <div class="text-sm font-light text-slate-500">
            <p class="text-sm font-normal text-slate-700">Billed To</p>
            <p>{{ $city }}</p>
            <p>Road {{ $road }}</p>
            <p>Block {{ $block }}</p>
            <p>House {{ $house }}</p>
            </div>
            <div class="text-sm font-light text-slate-500">
            <p class="text-sm font-normal text-slate-700">Invoice Number</p>
            <p>{{ $order }}</p>
    
            <p class="mt-2 text-sm font-normal text-slate-700">
                Date of Issue
            </p>
            <p>{{ $date }}</p>
            </div>
            <div class="text-sm font-light text-slate-500">
            <p class="text-sm font-normal text-slate-700">Order Status</p>
            <p>{{ $order_status }}</p>          
            </div>
            </div>
            </div>
        </div>
<!-- table start -->
@php
    $orderDetails = \App\Models\OrderDetail::where('orderID', $order)->get();
@endphp

<div class="p-9">
    <div class="flex flex-col mx-0 mt-8">
        <table class="min-w-full divide-y divide-slate-500">
            <thead>
                <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-normal text-slate-700 sm:pl-6 md:pl-0">
                        Product
                    </th>
                    <th scope="col" class="hidden py-3.5 px-3 text-right text-sm font-normal text-slate-700 sm:table-cell">
                        Quantity
                    </th>
                    <th scope="col" class="hidden py-3.5 px-3 text-right text-sm font-normal text-slate-700 sm:table-cell">
                        Price Per Unit
                    </th>
                    <th scope="col" class="py-3.5 pl-3 pr-4 text-right text-sm font-normal text-slate-700 sm:pr-6 md:pr-0">
                        Total
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderDetails as $orderDetail)
                @php
                    $product = \App\Models\Product::find($orderDetail->productID);
                @endphp
                <tr class="border-b border-slate-200">
                    <td class="py-4 pl-4 pr-3 text-sm sm:pl-6 md:pl-0">
                        <div class="font-medium text-slate-700">{{ $product->name }}</div>
                    </td>
                    <td class="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell">
                        {{ $orderDetail->quantity }}
                    </td>
                    <td class="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell">
                        {{ $product->price }} BD
                    </td>
                    <td class="py-4 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                        {{ $orderDetail->quantity * $product->price }} BD
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th scope="row" colspan="3" class="hidden pt-4 pl-6 pr-3 text-sm font-normal text-right text-slate-700 sm:table-cell md:pl-0">
                        Total
                    </th>
                    <td class="pt-4 pl-3 pr-4 text-sm font-normal text-right text-slate-700 sm:pr-6 md:pr-0">
                        {{ $total_price }} BD
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- table end -->
<div class="mt-48 p-9">
    <div class="border-t pt-9 border-slate-200">
        <div class="text-sm font-light text-slate-700">
            <p>
                By making a payment for this invoice, you acknowledge and agree to comply with the following conditions related to our online pharmacy system:
            </p>
            <ol class="list-decimal ml-6">
                <li>
                    <strong>Prescription Requirement:</strong> Valid prescription from a licensed healthcare professional is mandatory for all orders.
                </li>
                <li>
                    <strong>Personal Information:</strong> Your personal information will be collected and processed in accordance with our privacy policy.
                </li>
                <li>
                    <strong>Medication Usage:</strong> Use the medications as prescribed by your healthcare provider; unauthorized use or misuse is strictly prohibited.
                </li>
                <li>
                    <strong>Product Returns:</strong> We cannot accept returns or exchanges for dispensed medications due to safety and regulatory reasons.
                </li>
            </ol>
        </div>
    </div>
</div>
        </div>
        </article>
        </div>
</div>
</div>
@endsection
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #printable-content, #printable-content * {
            visibility: visible;
        }
        #printable-content {
            position: absolute;
            left: 0;
            top: 0;
            margin-top: 0 !important;
        }            
    }

</style>
