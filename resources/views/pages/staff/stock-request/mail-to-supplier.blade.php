@extends('layouts.staff-layout')

@section('staff-content')
    <section class="bg-white">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <x-errors></x-errors>
            <x-fail-message></x-fail-message>
            <x-success-message></x-success-message>
            <h2 class="mb-4 text-xl font-bold text-gray-900">Send Email</h2>
            <form method="POST" action="{{ route('send.email') }}">
                @csrf

                <input type="hidden" name="supplierId" value="{{ $supplier->id }}">
                <input type="hidden" name="productId" value="{{ $productId }}">

                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <span>To: {{ $supplier->company_name }}</span>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="subject" class="block mb-2 text-sm font-medium text-gray-900">Subject</label>
                        <input type="text" name="subject" id="subject" readonly
                            class="bg-gray-50 border-2 border-solid border-gray-300 text-gray-900 text-sm rounded-lg focus:border-purple-500 block w-full p-2.5"
                            value="{{ $subject }}">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="emailBody" class="block mb-2 text-sm font-medium text-gray-900">Email Body</label>
                        <textarea name="emailBody" id="emailBody" rows="5"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:border-purple-500 border-2 border-solid"
                            placeholder="Type your email content here">{{ old('emailBody') }}</textarea>
                    </div>
                </div>

                <button type="submit"
                    class="mt-4 py-2 px-4 bg-purple-600 text-white rounded-lg hover:bg-purple-700 focus:outline-none focus:bg-purple-700">
                    Send
                </button>
            </form>
        </div>
    </section>
@endsection
