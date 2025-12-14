<x-app-layout>
<div class="container mx-auto py-8">
<x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight">
            My Orders
        </h2>
        
    </x-slot>

    <!-- BUTTONS Section-->
    <div class="py-4">
        <div class="max-w-7xl mx-auto ">

        @php
      // Total orders
      $orderCount = $allorders->count();

      // Counts by status (case-insensitive match)
      $draftCount         = $allorders->where('status', 'draft')->count();
      $paidCount          = $allorders->where('status', 'paid')->count();
      $constructionCount  = $allorders->where('status', 'in construction')->count();
      $dispatchedCount    = $allorders->where('status', 'dispatched')->count();
    @endphp

{{-- Use the existing outer container; no extra max-w / px here --}}
<div class="grid grid-cols-4 gap-6 mb-8 w-full">
  {{-- Amount of Orders --}}
  <div class="bg-white border border-gray-200 rounded-xl p-6 text-center">
    <p class="text-sm font-semibold text-gray-500">Total Orders</p>
    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $orderCount }}</p>
  </div>

  {{-- Paid --}}
  <div class="bg-white border border-gray-200 rounded-xl p-6 text-center">
    <p class="text-sm font-semibold text-gray-500">Paid</p>
    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $paidCount }}</p>
  </div>

  {{-- In Construction --}}
  <div class="bg-white border border-gray-200 rounded-xl p-6 text-center">
    <p class="text-sm font-semibold text-gray-500">In Construction</p>
    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $constructionCount }}</p>
  </div>

  {{-- Dispatched --}}
  <div class="bg-white border border-gray-200 rounded-xl p-6 text-center">
    <p class="text-sm font-semibold text-gray-500">Dispatched</p>
    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $dispatchedCount }}</p>
  </div>

</div>

<br>

    <div class="max-w-7xl mx-auto ">

<!-- Filters (Status + Sorting) -->
<div class="flex justify-end mb-4 mt-4">
    <!-- Status Filter -->
    <form method="GET" action="{{ route('orders.index') }}" class="flex items-center">
       
        <select name="status" id="status" class="px-5 py-2 rounded-lg bg-white text-black border mr-2" onchange="this.form.submit()">
            <option value="">All</option>
            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft ({{ $draftCount }})</option>
            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid ({{ $paidCount }})</option>
            <option value="in_construction" {{ request('status') == 'in_construction' ? 'selected' : '' }}>In Construction ({{ $constructionCount }})</option>
            <option value="dispatched" {{ request('status') == 'dispatched' ? 'selected' : '' }}>Dispatched ({{ $dispatchedCount }})</option>
        </select>
    </form>

    <!-- Sorting Filter -->
    <form method="GET" action="{{ route('orders.index') }}" class="flex items-center mr-12">
       
        <select name="sort" id="sort" class="px-10 py-2 rounded-lg bg-white text-black border" onchange="this.form.submit()">
            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Newest First</option>
            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Oldest First</option>
        </select>
    </form>
</div>




        <div class="">
        <div class=" mx-auto ">
            <div class="bg-yellow overflow-hidden">

        @if ($orders->isEmpty())
            <p class="p-6 text-gray-900">No orders found.</p>
        @else
            <div class="overflow-x-aut">
            <table class="w-full mx-auto border-separate min-w-full border-spacing-y-3">
    <thead>
        <tr class="text-black">
            <th class="px-4 py-2   text-left">Order ID</th>
            <th class="px-4 py-2  text-left">Created At</th>
            <th class="px-4 py-2  text-left">Name</th>
            <th class="px-4 py-2   text-left">Email</th>
            <th class="px-4 py-2  text-left">Occasion</th>
            <th class="px-4 py-2   text-left">Status</th>
           
        </tr>
    </thead>

    <tbody>
        @foreach ($orders as $order) 
        <tr class="bg-gray-100 clickable-row border border-emerald-950 hover:bg-gray-300 hover:border-emerald-950 cursor-pointer 
    transition duration-200 ease-in-out"
    onclick="window.location='{{ route('orders.show', ['orders' => $order->id]) }}'">
    
    <td class="transition duration-200 ease-in-out px-4 py-5 border-t border-b border-l rounded-l-lg font-black">
        #{{ $order->order_number }}
    </td>
    <td class="transition duration-200 ease-in-out px-4 py-5 border-t border-b">
        {{ $order->created_at->format('d M Y') }}
    </td>
    <td class="transition duration-200 ease-in-out px-4 py-5 border-t border-b">
        {{ $order->name }}
    </td>
    <td class="transition duration-200 ease-in-out px-4 py-5 border-t border-b">
        {{ $order->email }}
    </td>
    <td class="transition duration-200 ease-in-out px-4 py-5 border-t border-b">
        {{ $order->occasion }}
    </td>
    <td class="px-4 py-5 border-t border-b border-r rounded-r-lg">
        <span class="px-3 py-1 text-sm font-semibold rounded-full transition duration-200 ease-in-out 
            {{ $order->status === 'draft' ? 'bg-gray-300 text-gray-950' : 
               ($order->status === 'paid' ? 'bg-green-300 text-green-950' : 
               ($order->status === 'in construction' ? 'bg-yellow-300 text-yellow-950' : 
               ($order->status === 'dispatched' ? 'bg-blue-300 text-blue-950' : 'text-gray-950 border border-gray-300'))) }}
            !text-gray-950 !bg-opacity-100">
            {{ $order->status }}
        </span>
    </td>
</tr>






        @endforeach
    </tbody>
</table>

            </div>
        @endif

        </div>
     </div> 
    </div>
</div>
</div>


    
</x-app-layout>