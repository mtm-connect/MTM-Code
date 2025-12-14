@extends('layouts.guest') {{-- or layouts.app if you prefer --}}

@section('content')
<div class="min-h-screen bg-emerald-950">

    <!-- Logo -->
    <div class="flex justify-center items-center pt-12 mb-8">
        <x-application-logo class="w-20 h-20 fill-current text-white" />
    </div>

    <div class="max-w-2xl mx-auto pb-12 px-4 text-white">

    {{-- Header grid: order info + ZIP button --}}
<div class="grid grid-cols-2 w-full mb-12 mt-2">
    
    {{-- Left side --}}
    <div>
        <h1 class="text-2xl font-bold mb-1">
            Order #{{ $order->order_number }}
        </h1>
        <p class="text-emerald-100">
       Client: {{ $order->user->company }}
        </p>
    </div>

    {{-- Right side --}}
    @if(isset($zipDownloadUrl))
        <div class="flex justify-end items-center w-full">
            <a href="{{ $zipDownloadUrl }}"
               class="inline-flex items-center px-5 py-3 bg-white text-black font-semibold text-sm rounded-lg shadow hover:bg-emerald-100 transition">
                {{-- Icon --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4"/>
                </svg>
                Download Full ZIP (PDFs)
            </a>
        </div>
    @endif
</div>

{{-- Item table in a white card --}}
<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="min-w-full text-sm text-gray-800">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 text-left">Item No.</th>
                <th class="px-4 py-2 text-left">Type</th>
                <th class="px-4 py-2 text-left">Measurement</th>
            </tr>
        </thead>

        <tbody>
            @forelse($items as $overview)

                @php
                    $itemUrl = URL::signedRoute('factory.orders.items.show', [
                        'order'    => $order->id,
                        'overview' => $overview->id,
                    ]);
                @endphp

                <tr class="border-t hover:bg-gray-50 cursor-pointer"
                    onclick="window.location='{{ $itemUrl }}'">

                    {{-- Item number --}}
                    <td class="px-4 py-2 font-medium">
                        {{ $overview->item_number ?? '—' }}
                    </td>

                    {{-- Type --}}
                    <td class="px-4 py-2">
                        {{ ucfirst(str_replace('_', ' ', $overview->type)) }}
                    </td>

                    {{-- Measurement name --}}
                    <td class="px-4 py-2">
                        {{ $overview->measurement?->name ?? '—' }}
                    </td>

                </tr>

            @empty
                <tr>
                    <td colspan="3" class="px-4 py-4 text-center text-gray-500">
                        No items found for this order.
                    </td>
                </tr>
            @endforelse
        </tbody>
      
        </div>

    </div>
</div>
@endsection
