<x-admin-layout>
    <div class="container mx-auto py-8">
        <x-slot name="header">
            <h2 class="font-semibold text-3xl text-white leading-tight">
                My Orders
            </h2>
        </x-slot>

        @php
            // Use the unfiltered collection for stats
            $orderCount       = $allOrders->count();
            $paidCount        = $allOrders->where('status', 'paid')->count();
            $constructionCount= $allOrders->where('status', 'in construction')->count();
            $dispatchedCount  = $allOrders->where('status', 'dispatched')->count();
        @endphp

        <!-- STATS CARDS -->
        <div class="py-4">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-4  gap-6 mb-8 w-full">
                    {{-- Total Orders --}}
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
            </div>
        </div>

        <!-- ORDERS TABLE -->
        <div class="max-w-7xl mx-auto">
            <div class="mx-auto">
                <div class="bg-yellow overflow-hidden">
                    @if ($orders->isEmpty())
                        <p class="p-6 text-gray-900">No orders found.</p>
                    @else
                        <div class="overflow-x-aut">
                        <table class="w-full mx-auto border-separate min-w-full border-spacing-y-3 text-center">
    <thead>
        <tr class="text-black">
            <th class="px-4 py-2">Order ID</th>
            <th class="px-4 py-2">Created At</th>
            <th class="px-4 py-2">Client</th>
            <th class="px-4 py-2">Company</th>
    
            <th class="px-4 py-2">Occasion</th>
            <th class="px-4 py-2">Total Price</th>
            <th class="px-4 py-2">Status</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($orders as $order)
            @php
                // Calculate total price for each order
                $totalPrice = $order->orderOverviews->sum('price');

                // Fetch company from the user table
                $company = optional($order->user)->company ?? '—';

                // Apply memorised colours
                $badge = match (strtolower($order->status)) {
                    'draft'           => 'bg-gray-300 text-gray-950',
                    'paid'            => 'bg-green-300 text-green-950',
                    'in construction' => 'bg-yellow-300 text-yellow-950',
                    'dispatched'      => 'bg-blue-300 text-blue-950',
                    default           => 'bg-gray-200 text-gray-900',
                };
            @endphp

            <tr class="bg-gray-100 clickable-row border border-emerald-950 hover:bg-gray-300 hover:border-emerald-950 
                       cursor-pointer transition duration-200 ease-in-out text-center"
                onclick="window.location='{{ route('admin.orders.show', ['orders' => $order->id]) }}'">

                <td class="px-4 py-5 border-t border-b border-l rounded-l-lg font-black">
                    #{{ $order->order_number }}
                </td>

                <td class="px-4 py-5 border-t border-b">
                    {{ $order->created_at->format('d M Y') }}
                </td>

                <td class="px-4 py-5 border-t border-b">
                    {{ $order->name }}
                </td>

                <td class="px-4 py-5 border-t border-b">
                    {{ $company }}
                </td>

             

                <td class="px-4 py-5 border-t border-b">
                    {{ $order->occasion }}
                </td>

                <td class="px-4 py-5 border-t border-b font-semibold">
                    £{{ number_format($totalPrice, 2) }}
                </td>

                <td class="px-4 py-5 border-t border-b border-r rounded-r-lg">
                    <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $badge }}">
                        {{ ucfirst($order->status) }}
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
