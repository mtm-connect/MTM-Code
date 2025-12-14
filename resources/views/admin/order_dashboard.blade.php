<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight">
            Order: #{{ $orders->order_number }}
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

    @if (session('Unsuccessful'))
        <div class="mt-12 max-w-7xl mx-auto w-auto rounded-xl p-4 text-center border" style="color: #7f1d1d; border-color: #7f1d1d;">
            <h1 class="text-xl font-bold">Payment Unsuccessful</h1>
            <p class="text-sm mt-2 font-medium">Please try again.</p>
        </div>
    @endif

    <!-- BUTTONS Section-->
    <div class="py-12">
        <div class="max-w-7xl mx-auto ">

            @php
                $itemsCount = $orderOverviews->count();
                $measCount  = $measurements->count();

                $statusKey = strtolower(str_replace(' ', '_', trim($orders->status)));
                $statusMap = [
                    'draft'            => ['Draft', 'bg-gray-300 text-gray-900'],
                    'paid'             => ['Paid', 'bg-green-300 text-green-900'],
                    'in_construction'  => ['In Construction', 'bg-yellow-300 text-yellow-900'],
                    'dispatched'       => ['Dispatched', 'bg-blue-300 text-blue-900'],
                    
                ];
                [$statusLabel, $statusClasses] = $statusMap[$statusKey]
                    ?? [ucwords(str_replace('_',' ', $statusKey)), 'bg-slate-200 text-slate-900'];

                $showPayment = ($itemsCount > 0) && ($statusKey === 'draft');
            @endphp

            {{-- Use the existing outer container; no extra max-w / px here --}}
            <div class="grid grid-cols-4 gap-6 mb-8 w-full">
                {{-- Total Price --}}
                <div class="bg-white border border-gray-200 rounded-xl p-6 text-center">
                    <p class="text-sm font-semibold text-gray-500">Total Price</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900">£{{ number_format(($totalPrice ?? 0), 2) }}</p>
                </div>

                {{-- Items --}}
                <div class="bg-white border border-gray-200 rounded-xl p-6 text-center">
                    <p class="text-sm font-semibold text-gray-500">Items</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $itemsCount }}</p>
                </div>

                {{-- Measurements --}}
                <div class="bg-white border border-gray-200 rounded-xl p-6 text-center">
                    <p class="text-sm font-semibold text-gray-500">Measurements</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $measCount }}</p>
                </div>

                {{-- 4th: Payment (black) OR Status (colored) --}}
                @if ($showPayment)
                    <a href="{{ route('checkout', ['orders' => $orders->id]) }}"
                       class="block w-full h-full rounded-xl p-6 text-center transition
                               bg-black text-white shadow-sm
                               hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900">
                        <p class="text-sm font-semibold opacity-80">Payment</p>
                        <p class="mt-2 text-2xl font-bold">Pay £{{ number_format(($totalPrice ?? 0), 2) }}</p>
                    </a>
                @else
                    <div class="rounded-xl p-6 text-center font-semibold {{ $statusClasses }}">
                        <p class="text-sm opacity-75">Status</p>
                        <p class="mt-2 text-2xl font-bold">{{ $statusLabel }}</p>
                    </div>
                @endif
            </div>

            <!-- MEASUREMENTS and ITEMS Section Side by Side -->
            <div class="flex justify-between gap-4 ">

                <!-- Info Section (50%) -->
                <div name="measure_section" class=" w-1/2 py-6">
                    <div class="  ">
                        <div class="w-full mx-auto mt-4 mb-6 p-6 bg-white border-grey-300 rounded-lg  border  z-100">
                            <!-- Flex container for Name and Status Pill -->
                            <div class="flex justify-between items-center mb-4">
                                <!-- Name Heading -->
                                <h1 class="text-3xl font-semibold text-gray-700">{{ $orders->name }}</h1>

                                <!-- Status Pill at the top-right corner -->
                                <span class="inline-block text-sm font-semibold 
                                    {{ 
                                        $orders->status === 'draft' ? 'bg-gray-300 text-gray-950' :
                                        ($orders->status === 'paid' ? 'bg-green-300 text-green-950' :
                                        ($orders->status === 'In Construction' ? 'bg-purple-300 text-purple-950' :
                                        ($orders->status === 'Fulfilled' ? 'bg-yellow-300 text-yellow-700' : 'text-gray-950')))
                                    }} 
                                    px-3 py-1 rounded-full">
                                    {{ $orders->status }}
                                </span>
                            </div>

                            <!-- Grid for content -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                
                                <!-- Phone Number and Email columns -->
                                <div class="flex flex-col pb-4">
                                    <span class="font-semibold text-gray-700">Phone Number</span>
                                    <span class="text-gray-600">{{ $orders->phone_number }}</span>
                                </div>
                                
                                <div class="flex flex-col pb-4 max-w-full">
                                    <span class="font-semibold text-gray-700">Email</span>
                                    <span class="text-gray-600 break-words overflow-hidden whitespace-normal w-full">
                                        {{ $orders->email }}
                                    </span>
                                </div>

                                <!-- Occasion and Date Required columns -->
                                <div class="flex flex-col pb-4">
                                    <span class="font-semibold text-gray-700">Occasion</span>
                                    <span class="text-gray-600">{{ $orders->occasion }}</span>
                                </div>
                                
                                <div class="flex flex-col pb-4">
                                    <span class="font-semibold text-gray-700">Date Required</span>
                                    <span class="text-gray-600">{{ $orders->date_required }}</span>
                                </div>

                                <!-- Address section, taking full width -->
                                <div class="flex flex-col md:col-span-2 pb-4">
                                    <span class="font-semibold text-gray-700">Address</span>
                                    <span class="text-gray-600">{{ $orders->address_line_1 }} {{ $orders->address_line_2 }} {{ $orders->post_code }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <div class=" border bg-emerald-950 border-emerald-950 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="px-6 py-6 text-gray-900">
                                <!-- Flex container for Measurements Title and Add Measurements Button -->
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="font-semibold text-xl text-white">
                                        Measurements
                                    </h2>
                                    
                                    <!-- Add Measurements Button aligned to the right -->
                                    <button onclick="window.location='{{ route('measurments.form', ['id' => $orders->id]) }}'" class='inline-flex items-center px-4 py-4 bg-white border border-transparent rounded-full font-semibold text-xs text-black uppercase tracking-widest hover:bg-gray-100 focus:bg-1ray-300 active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 transition ease-in-out duration-150'>
                                        Add Measurements
                                    </button>
                                </div>

                                <!-- Measurements Table Section -->
                                @if ($measurements->isEmpty())
                                    <div class="flex items-center justify-center text-white my-10">
                                        <!-- SVG Icon (X for close) -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <p>No Measurements Added</p>
                                    </div>
                                @else
                                    <div class="overflow-x-auto">
                                        <table class="w-full mx-auto border-collapse min-w-full   rounded-lg shadow-md ">
                                            <thead>
                                                <tr class="bg-emerald-950 text-white opacity-60">
                                                    <th class="px-4 py-3  text-left">Name</th>
                                                    <th class="px-4 py-3  text-left">DOB</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($measurements as $measurement)
                                                    <tr onclick="window.location='{{ route('measurements.show', ['measurement' => $measurement->id, 'orders' => $orders->id]) }}'"
                                                        class="clickable-row cursor-pointer hover:opacity-60 text-white transition-opacity duration-300">
                                                        <td class="px-4 py-3">{{ $measurement->name }}</td>
                                                        <td class="px-4 py-3">{{ $measurement->dob }}</td>
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
                <!-- END OF MEASUREMENTS SECTION -->
                 

                <!-- ITEMS Section (50%) -->
                <div name="list_section" class="w-1/2 py-6 ">
                    <!-- ===== Empty Card ABOVE Items (Controls) ===== -->
                    @php
                        $status = strtolower(trim($orders->status));
                        $showSendButton = $status === 'paid';
                        $showDispatchButton = $status === 'in construction';
                        // Enable Send only if at least one item AND one measurement exist
                        $canSend = ($itemsCount > 0) && ($measCount > 0);
                    @endphp

                    <div class="mt-4 bg-white border border-gray-200 rounded-xl p-6 mb-4 flex items-center justify-between">
                        <p class="text-gray-900 font-semibold mr-4">Controls</p>

                        <div class="flex items-center gap-3">
                            {{-- ===== Send Order (only when Paid) ===== --}}
                            @if ($showSendButton)
                                <div x-data="{ open: false }" class="relative">
                                    <form x-ref="sendForm" action="{{ route('admin.orders.send', $orders) }}" method="POST">
                                        @csrf
                                        <button type="button"
                                            @click="open = true"
                                            class='inline-flex items-center px-4 py-4 bg-black border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-100 focus:bg-1ray-300 active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 transition ease-in-out duration-150'
                                            {{ $canSend ? '' : 'disabled' }}>
                                            <!-- Paper airplane icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 10l19-7-7 19-4-6-6-4z" />
                                            </svg>
                                            Send Order
                                        </button>
                                    </form>

                                    <!-- Confirmation Modal -->
                                    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
                                        <!-- Dark overlay -->
                                        <div class="absolute inset-0 opacity-50 bg-black " @click="open = false"></div>

                                        <!-- Modal Box -->
                                        <div class="relative bg-white rounded-xl shadow-lg max-w-md w-1/4 p-6">
                                            <h3 class="text-lg font-semibold text-gray-900">Send this order?</h3>
                                            <p class="mt-2 text-sm text-gray-600">
                                                This will mark the order (#{{ $orders->order_number }}) as  <span class="font-semibold">In Construction</span>,
                                                and send to the factory.
                                            </p>

                                            <div class="mt-6 flex justify-end gap-3">
                                                <button type="button"
                                                    @click="open = false"
                                                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                                                    Cancel
                                                </button>

                                                <button type="button"
                                                    @click="$refs.sendForm.submit()"
                                                    class="px-4 py-2 rounded-lg bg-black text-white hover:bg-gray-800">
                                                    Yes, Send Order
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif


                            {{-- ===== Mark as Dispatched (only when In Construction) ===== --}}
                            @if ($showDispatchButton)
                                {{-- Mark as Dispatched --}}
                                <form action="{{ route('admin.orders.dispatch', $orders) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class='inline-flex items-center px-4 py-4 bg-black border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-100 focus:bg-1ray-300 active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 transition ease-in-out duration-150'
                                        {{ $canSend ? '' : 'disabled' }}>
                                        Mark as Dispatched
                                    </button>
                                </form>

                                {{-- Resend Order (if you want to use the same "send" action) --}}
                                <form action="{{ route('admin.orders.send', $orders) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                           class='inline-flex items-center px-4 py-4 bg-black border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-100 focus:bg-1ray-300 active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 transition ease-in-out duration-150'
                                            {{ $canSend ? '' : 'disabled' }}>
                                        <!-- Paper airplane icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M3 10l19-7-7 19-4-6-6-4z" />
                                        </svg>
                                        Resend Order
                                    </button>
                                </form>
                            @endif


                            {{-- ===== Delete Order (always visible) ===== --}}
                            <form action="{{ route('admin.orders.destroy', $orders) }}" method="POST"
                                  onsubmit="return confirm('Delete this order permanently? This cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                class='inline-flex items-center px-4 py-4 bg-red-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-100 focus:bg-1ray-300 active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 transition ease-in-out duration-150'
                                {{ $canSend ? '' : 'disabled' }}>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0V5a2 2 0 012-2h2a2 2 0 012 2v2"/>
                                    </svg>
                                    Delete Order
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- =================================== -->

                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    </div>

                    <div class="mt-4 bg-emerald-950 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            
                            @php
                                // Show item buttons only when status is draft
                                $showItemButtons = ($statusKey === 'draft');
                                // Still disable the buttons if there are no measurements
                                $disabledForMeas = $measurements->isEmpty();
                                $disabledAttrs   = $disabledForMeas ? 'disabled' : '';
                                $disabledClasses = $disabledForMeas ? 'opacity-50 cursor-not-allowed' : '';
                            @endphp

                            @if ($showItemButtons)
                                <!-- Row 1: 2 Piece + 3 Piece (50/50) -->
                                <div class="mb-4 grid grid-cols-2 gap-4 w-full">
                                    <!-- 2 Piece -->
                                    <button
                                        onclick="window.location='{{ route('two.form', ['id' => $orders->id]) }}'"
                                        class="relative w-full group inline-flex items-center justify-center py-16 px-4 bg-cover bg-center rounded-md text-xs font-semibold text-white uppercase tracking-widest transition ease-in-out duration-150 hover:border-opacity-80 {{ $disabledClasses }}"
                                        style="background-image: url('{{ asset('images/2_piece.jpg') }}');"
                                        {{ $disabledAttrs }}>
                                        <span class="absolute inset-0 z-0 bg-black opacity-30 transition-opacity duration-300 group-hover:opacity-50 group-active:opacity-70 rounded-md pointer-events-none"></span>
                                        <span class="relative z-10 text-lg font-semibold text-shadow-lg">2 Piece</span>
                                    </button>

                                    <!-- 3 Piece -->
                                    <button
                                        onclick="window.location='{{ route('three.form', ['id' => $orders->id]) }}'"
                                        class="relative w-full group inline-flex items-center justify-center py-16 px-4 bg-cover bg-center rounded-md text-xs font-semibold text-white uppercase tracking-widest transition ease-in-out duration-150 hover:border-opacity-80 {{ $disabledClasses }}"
                                        style="background-image: url('{{ asset('images/3_piece.jpg') }}');"
                                        {{ $disabledAttrs }}>
                                        <span class="absolute inset-0 z-0 bg-black opacity-30 transition-opacity duration-300 group-hover:opacity-50 group-active:opacity-70 rounded-md pointer-events-none"></span>
                                        <span class="relative z-10 text-lg font-semibold text-shadow-lg">3 Piece</span>
                                    </button>
                                </div>

                                <!-- Row 2: Jacket + Waistcoat + Shirt -->
                                <div class="mb-4 grid grid-cols-3 gap-4 w-full">
                                    <!-- Jacket -->
                                    <button
                                        onclick="window.location='{{ route('jacket.form', ['id' => $orders->id]) }}'"
                                        class="relative w-full group inline-flex items-center justify-center py-24 px-4 bg-cover bg-center rounded-md text-xs font-semibold text-white uppercase tracking-widest transition ease-in-out duration-150 hover:border-opacity-80 {{ $disabledClasses }}"
                                        style="background-image: url('{{ asset('images/jacket.jpg') }}');"
                                        {{ $disabledAttrs }}>
                                        <span class="absolute inset-0 z-0 bg-black opacity-30 transition-opacity duration-300 group-hover:opacity-50 group-active:opacity-70 rounded-md pointer-events-none"></span>
                                        <span class="relative z-10 text-lg font-semibold text-shadow-lg">Jacket</span>
                                    </button>

                                    <!-- Waistcoat -->
                                    <button
                                        onclick="window.location='{{ route('waistcoat.form', ['id' => $orders->id]) }}'"
                                        class="relative w-full group inline-flex items-center justify-center py-24 px-4 bg-cover bg-center rounded-md text-xs font-semibold text-white uppercase tracking-widest transition ease-in-out duration-150 hover:border-opacity-80 {{ $disabledClasses }}"
                                        style="background-image: url('{{ asset('images/waistcoat.jpg') }}');"
                                        {{ $disabledAttrs }}>
                                        <span class="absolute inset-0 z-0 bg-black opacity-30 transition-opacity duration-300 group-hover:opacity-50 group-active:opacity-70 rounded-md pointer-events-none"></span>
                                        <span class="relative z-10 text-lg font-semibold text-shadow-lg">Waistcoat</span>
                                    </button>

                                    <!-- Shirt -->
                                    <button
                                        onclick="window.location='{{ route('shirt.form', ['id' => $orders->id]) }}'"
                                        class="relative w-full group inline-flex items-center justify-center py-24 px-4 bg-cover bg-center rounded-md text-xs font-semibold text-white uppercase tracking-widest transition ease-in-out duration-150 hover:border-opacity-80 {{ $disabledClasses }}"
                                        style="background-image: url('{{ asset('images/shirt.jpg') }}');"
                                        {{ $disabledAttrs }}>
                                        <span class="absolute inset-0 z-0 bg-black opacity-30 transition-opacity duration-300 group-hover:opacity-50 group-active:opacity-70 rounded-md pointer-events-none"></span>
                                        <span class="relative z-10 text-lg font-semibold text-shadow-lg">Shirt</span>
                                    </button>
                                </div>
                            @endif

                            <!-- Items Table Section -->
                            <h2 class="mt-4 ml-4 mb-4 font-semibold text-xl text-white">
                                Items
                            </h2>

                            @if ($orderOverviews->isEmpty())
                                <div class="flex items-center justify-center text-white my-10">
                                    <!-- SVG Icon (X for close) -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    <p>No Items Added</p>
                                </div>
                            @else
                                <div class="overflow-x-auto">
                                    <table class="w-full mx-auto border-collapse min-w-full rounded-lg">
                                        <thead>
                                            <tr class="bg-emerald-950 text-white opacity-60">
                                                <th class="px-4 py-3 text-left">Item</th>
                                                <th class="px-4 py-3 text-left">Item No.</th>
                                                <th class="px-4 py-3 text-left">For</th>
                                                <th class="px-4 py-3 text-left">Price</th>
                                                <th class="px-4 py-3 text-left">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderOverviews as $orderOverview)
                                                @php
                                                    $measurementId = optional($orderOverview->measurement)->id;
                                                @endphp

                                                <tr class="clickable-row cursor-pointer hover:opacity-60 transition-opacity duration-300" 
                                                    onclick="window.location='{{ route('admin.orders.items.edit', [
                                                        'orders'        => $orders->id,
                                                        'orderoverview' => $orderOverview->id,
                                                        'measurement'   => $measurementId,
                                                    ]) }}'">

                                                    <!-- Item Type -->
                                                    <td class="px-4 py-3 text-white">{{ $orderOverview->type }}</td>

                                                    <!-- Item Number -->
                                                    <td class="px-4 py-3 text-white">
                                                        {{ $orderOverview->item_number }}
                                                    </td>

                                                    <!-- Measurement / For -->
                                                    <td class="px-4 py-3 text-white">
                                                        @if ($orderOverview->measurement)
                                                            {{ $orderOverview->measurement->name }}
                                                        @else
                                                            Measurement not found
                                                        @endif
                                                    </td>

                                                    <!-- Price -->
                                                    <td class="px-4 py-3 text-white">£{{ number_format($orderOverview->price, 2) }}</td>

                                                    <!-- Status -->
                                                    <td class="px-4 py-3">
                                                        <span class="inline-block text-xs font-semibold 
                                                            {{ 
                                                                $orders->status === 'draft' ? 'bg-gray-300 text-gray-950' :
                                                                    ($orders->status === 'paid' ? 'bg-green-300 text-green-950' :
                                                                    ($orders->status === 'In Construction' ? 'bg-purple-300 text-purple-950' :
                                                                    ($orders->status === 'Fulfilled' ? 'bg-yellow-300 text-yellow-700' : 'text-gray-950')))
                                                            }} 
                                                            px-3 py-1 rounded-full">
                                                            {{ $orderOverview->status }}
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
                <!-- END OF ITEMS SECTION -->

            </div>
        </div>
    </div>

    <style>
        /* Add fade effect for disabled buttons */
        .opacity-50[disabled] {
            opacity: 0.5;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
    </style>
</x-admin-layout>
