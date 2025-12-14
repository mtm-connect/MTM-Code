<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight">
            {{ $client->company }}
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="mt-12 max-w-7xl mx-auto w-auto rounded-xl p-2 text-center border"
             style="color: #064e3b; border-color: #064e3b;">
            <h1 class="text-xl font-bold">
                {{ session('success') }}
            </h1>
        </div>
    @endif

    <!-- MAIN WRAPPER -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto">

            {{-- TOP STATS --}}
            <div class="grid grid-cols-4 gap-6  w-full">
                {{-- Total Spent --}}
                <div class="bg-white border border-gray-200 rounded-xl p-6 text-center flex flex-col items-center justify-center">
                    <p class="text-sm font-semibold text-gray-500">Total Spent</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900">
                        £{{ number_format($totalSpent ?? 0, 2) }}
                    </p>
                </div>

                {{-- Total Spent Last 30 Days --}}
                <div class="bg-white border border-gray-200 rounded-xl p-6 text-center flex flex-col items-center justify-center">
                    <p class="text-sm font-semibold text-gray-500">Spent (Last 30 Days)</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900">
                        £{{ number_format($totalSpentLast30 ?? 0, 2) }}
                    </p>
                </div>

                {{-- Number of Orders --}}
                <div class="bg-white border border-gray-200 rounded-xl p-6 text-center flex flex-col items-center justify-center">
                    <p class="text-sm font-semibold text-gray-500">Number of Orders</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900">
                        {{ $ordersCount }}
                    </p>
                </div>

                @php
    $subscription = $client->subscription ?? 'None';

    $subscriptionStyles = match($subscription) {
        'None'    => 'bg-red-100 border-red-300 text-red-950',
        'Basic'   => 'bg-gray-100 border-gray-300 text-gray-800',
        'Premium' => 'bg-black border-black text-white',
        
    };
@endphp

{{-- Subscription --}}
<div class="rounded-xl p-6 text-center flex flex-col items-center justify-center border {{ $subscriptionStyles }}">
    <p class="text-sm font-semibold opacity-80">Subscription</p>
    <p class="mt-2 text-2xl font-bold">
        {{ $subscription }}
    </p>
</div>

            </div>

            <!-- MAIN CONTENT: Info + Controls -->
            <div class="grid grid-cols-2 gap-6 ">

                <!-- Info Section (Client Details) -->
                <div class="w-full py-6">
                    <div class="w-full mx-auto mt-4 mb-6 p-6 bg-white border-grey-300 rounded-lg border">
                        <div class="flex justify-between items-center mb-4">
                            <h1 class="text-3xl font-semibold text-gray-700">
                                {{ $client->name }}
                            </h1>
                        
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Company & Email -->
                            <div class="flex flex-col pb-4">
                                <span class="font-semibold text-gray-700">Company</span>
                                <span class="text-gray-600">
                                    {{ $client->company ?? '—' }}
                                </span>
                            </div>

                            <div class="flex flex-col pb-4 max-w-full">
                                <span class="font-semibold text-gray-700">Email</span>
                                <span class="text-gray-600 break-words overflow-hidden whitespace-normal w-full">
                                    {{ $client->email }}
                                </span>
                            </div>

                            <!-- Phone & Country -->
                            <div class="flex flex-col pb-4">
                                <span class="font-semibold text-gray-700">Phone Number</span>
                                <span class="text-gray-600">{{ $client->phone_number ?? '—' }}</span>
                            </div>

                            <div class="flex flex-col pb-4">
                                <span class="font-semibold text-gray-700">Country</span>
                                <span class="text-gray-600">{{ $client->country ?? '—' }}</span>
                            </div>

                            <!-- Address -->
                            <div class="flex flex-col md:col-span-2 pb-4">
                                <span class="font-semibold text-gray-700">Address</span>
                                <span class="text-gray-600">
                                    {{ $client->address_line_1 }} {{ $client->address_line_2 }}
                                    {{ $client->post_code }} {{ $client->county }}
                                </span>
                            </div>

                            <!-- Client since -->
                            <div class="flex flex-col md:col-span-2 pb-1">
                                <span class="font-semibold text-gray-700">Client Since</span>
                                <span class="text-gray-600">
                                    {{ optional($client->created_at)->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Controls Section -->
                <div class="w-full py-6">
                    <div class="mt-4 bg-white border border-gray-200 rounded-xl p-6 mb-4 flex flex-col gap-4">
                        <div class="flex items-center justify-between">
                            <p class="text-gray-900 font-semibold mr-4">Controls</p>
                        </div>

                        @php
                            $subscriptionOptions = ['None', 'Basic', 'Premium'];
                        @endphp

                        <form method="POST" action="{{ route('admin.clients.subscription.update', $client) }}" class="flex flex-col sm:flex-row gap-3 items-start sm:items-center">
                            @csrf
                            @method('PATCH')

                            <div class="flex flex-col w-full">
                                <label for="subscription" class="text-sm font-semibold text-gray-700 mb-1">
                                    Subscription
                                </label>
                                <select
                                    id="subscription"
                                    name="subscription"
                                    class="px-4 py-2 rounded-full border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-1 focus:ring-black focus:border-black transition duration-200 ease-in-out"
                                >
                                    @foreach ($subscriptionOptions as $option)
                                        <option value="{{ $option }}" {{ $client->subscription === $option ? 'selected' : '' }}>
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit"
                                class="inline-flex items-center px-5 py-3 bg-black border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-800 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 transition ease-in-out duration-150">
                                Update Subscription
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            <!-- ORDERS TABLE -->
            <div class="mt-8">
                <h2 class="font-semibold text-2xl text-white mb-4">
                    Orders for {{ $client->name }}
                </h2>

                <div class="bg-yellow overflow-hidden">
                    @if ($orders->isEmpty())
                        <p class="p-6 text-gray-900">No orders for this client.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full mx-auto border-separate min-w-full border-spacing-y-3">
                                <thead>
                                    <tr class="text-black">
                                        <th class="px-4 py-2 text-left">Order ID</th>
                                        <th class="px-4 py-2 text-left">Created At</th>
                                        <th class="px-4 py-2 text-left">Occasion</th>
                                        <th class="px-4 py-2 text-left">Status</th>
                                        <th class="px-4 py-2 text-left">Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        @php
                                            $statusKey = strtolower(str_replace(' ', '_', trim($order->status)));
                                            $statusMap = [
                                                'draft'            => ['Draft', 'bg-gray-300 text-gray-900'],
                                                'paid'             => ['Paid', 'bg-green-300 text-green-900'],
                                                'in_construction'  => ['In Construction', 'bg-purple-300 text-purple-900'],
                                                'quality_control'  => ['Quality Control', 'bg-yellow-300 text-yellow-900'],
                                                'dispatched'       => ['Dispatched', 'bg-blue-300 text-blue-900'],
                                            ];
                                            [$statusLabel, $statusClasses] = $statusMap[$statusKey]
                                                ?? [ucwords(str_replace('_',' ', $statusKey)), 'bg-slate-200 text-slate-900'];

                                            $orderTotal = $order->orderOverviews->sum('price');
                                        @endphp

                                        <tr class="bg-gray-100 clickable-row border border-emerald-950 hover:bg-gray-300 hover:border-emerald-950 cursor-pointer transition duration-200 ease-in-out"
                                            onclick="window.location='{{ route('admin.orders.show', ['orders' => $order->id]) }}'">

                                            <td class="px-4 py-5 border-t border-b border-l rounded-l-lg font-black">
                                                #{{ $order->order_number }}
                                            </td>
                                            <td class="px-4 py-5 border-t border-b">
                                                {{ $order->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-4 py-5 border-t border-b">
                                                {{ $order->occasion }}
                                            </td>
                                            <td class="px-4 py-5 border-t border-b">
                                                <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $statusClasses }}">
                                                    {{ $statusLabel }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-5 border-t border-b border-r rounded-r-lg">
                                                £{{ number_format($orderTotal, 2) }}
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
