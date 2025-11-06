<x-admin-layout>
<div class="container mx-auto py-8">
<x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight">
            My Orders
        </h2>
        
    </x-slot>

<!-- Filters (Status + Sorting) -->
<div class="flex justify-end mb-4 mt-4">
    <!-- Status Filter -->
    <form method="GET" action="{{ route('admin.orders.index') }}" class="flex items-center">
        <label for="status" class="text-white font-semibold mr-2">Filter by Status:</label>
        <select name="status" id="status" class="px-5 py-2 rounded-lg bg-white text-black border" onchange="this.form.submit()">
            <option value="">All</option>
            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="in_construction" {{ request('status') == 'in_construction' ? 'selected' : '' }}>In Construction</option>
            <option value="quality_control" {{ request('status') == 'quality_control' ? 'selected' : '' }}>Quality Control</option>
            <option value="dispatched" {{ request('status') == 'dispatched' ? 'selected' : '' }}>Dispatched</option>
        </select>
    </form>

    <!-- Sorting Filter -->
    <form method="GET" action="{{ route('admin.orders.index') }}" class="flex items-center mr-12">
        <label for="sort" class="text-white font-semibold mr-2">Sort by:</label>
        <select name="sort" id="sort" class="px-10 py-2 rounded-lg bg-white text-black border" onchange="this.form.submit()">
            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Newest First</option>
            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Oldest First</option>
        </select>
    </form>
</div>




        <div class="">
        <div class=" mx-auto sm:px-6 lg:px-8">
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
    onclick="window.location='{{ route('admin.orders.show', ['orders' => $order->id]) }}'">
    
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
               ($order->status === 'In Construction' ? 'bg-purple-300 text-purple-950' : 
               ($order->status === 'Fulfilled' ? 'bg-yellow-300 text-yellow-700' : 'text-gray-950 border border-gray-300'))) }}
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

    
</x-admin-layout>