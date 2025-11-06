<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @php
        $draftCount        = (int)($draftCount ?? 0);
        $paidCount         = (int)($paidCount ?? 0);
        $constructionCount = (int)($constructionCount ?? 0);
        $dispatchedCount   = (int)($dispatchedCount ?? 0);
        $totalOrders       = $draftCount + $paidCount + $constructionCount + $dispatchedCount;

        // Fallbacks for compare chart
        $currentCount      = (int)($currentCount ?? 0);
        $previousCount     = (int)($previousCount ?? 0);
        $percentageChange  = isset($percentageChange)
                                ? (float)$percentageChange
                                : ($previousCount > 0
                                    ? (($currentCount - $previousCount) / max(1, $previousCount)) * 100
                                    : ($currentCount > 0 ? 100 : 0));

        // Fallback for total spent
        if (!isset($last30TotalAmount)) {
            $last30TotalAmount = \App\Models\OrderOverview::join('orders', 'order_overview.order_id', '=', 'orders.id')
                ->where('orders.user_id', auth()->id())
                ->where('order_overview.created_at', '>=', now()->subDays(30))
                ->sum('order_overview.price');
        }
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8 w-full">

                <!-- ===== Graph 1: Orders by Status (Donut) ===== -->
                <div class="bg-emerald-950 rounded-xl border shadow-sm p-12 flex flex-col items-center text-center">
                    <h2 class="text-xl font-semibold text-white mb-8 mt-12">
                        Orders by Status
                    </h2>

                    @if ($totalOrders > 0)
                        <div class="flex justify-center items-center mb-8 mt-8 relative">
                            <canvas id="ordersStatusChart" class="w-56 h-56"></canvas>
                        </div>
                    @else
                        <div class="flex-1 flex items-center justify-center text-center">
                            <p class="text-white  font-medium">No orders found.</p>
                        </div>
                    @endif

                    <div class="h-12"></div>
                </div>

                <!-- ===== Graph 2: Last 30 vs Previous 30 (Bar) ===== -->
                <div class="bg-white rounded-xl border shadow-sm p-12 flex flex-col">
                    <h2 class="text-xl font-semibold text-gray-800 mb-8 mt-12 text-center">
                        Last 30 Days
                    </h2>

                    <div class="flex-1 flex items-center justify-center px-12 mt-8">
                        <canvas id="ordersCompareChart" class="w-full h-64 max-w-xs md:max-w-sm lg:max-w-md"></canvas>
                    </div>

                    <div class="mb-6 mt-8 text-center">
                        @php $delta = number_format(abs($percentageChange), 1); @endphp

                        @if (($currentCount + $previousCount) === 0)
                            <p class="text-gray-500 font-semibold">No data for these periods</p>
                        @elseif ($percentageChange > 0)
                            <p class="text-green-600 font-semibold">▲ Up {{ $delta }}% from previous 30 days</p>
                        @elseif ($percentageChange < 0)
                            <p class="text-red-600 font-semibold">▼ Down {{ $delta }}% from previous 30 days</p>
                        @else
                            <p class="text-gray-600 font-semibold">No change</p>
                        @endif

                        <p class="text-sm text-gray-500 mt-1">
                            Last 30: <span class="font-medium text-gray-700">{{ $currentCount }}</span> •
                            Previous 30: <span class="font-medium text-gray-700">{{ $previousCount }}</span>
                        </p>
                    </div>
                </div>

                <!-- ===== Card 3: Total Spent (Last 30 Days) ===== -->
                <div class="bg-emerald-950 rounded-xl border shadow-sm p-12 flex flex-col items-center text-center">
                    <h2 class="text-xl font-semibold text-white mt-12 mb-6">
                        Total Spent (Last 30 Days)
                    </h2>

                    <div class="flex-1 flex flex-col items-center justify-center">
                        <p
                            class="font-extrabold text-white tracking-tight leading-none"
                            style="font-size: 4rem; line-height: 1;">
                            £{{ number_format((float)($last30TotalAmount ?? 0), 2) }}
                        </p>
                    </div>

                    <div class="h-6"></div>
                </div>
                <!-- ===== /Card 3 ===== -->

            <!-- ===== Wide Card: Recent Orders Table (Clickable Rows) ===== -->
<div class="bg-white border border-gray-200 rounded-xl p-6 md:p-8 lg:p-10 flex flex-col text-gray-800 col-span-1 md:col-span-2 lg:col-span-2 lg:col-start-1">
    <h2 class="text-lg font-semibold mb-6 text-gray-900">Recent Orders</h2>

    @if ($recentOrders->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full mx-auto border-separate min-w-full border-spacing-y-3 text-sm">
                <thead>
                    <tr class="text-gray-700">
                        <th class="px-4 py-2 text-left">#</th>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentOrders as $order)
                        @php
                            $badge = match(strtolower($order->status)) {
                                'draft' => 'bg-gray-300 text-gray-950',
                                'paid' => 'bg-green-300 text-green-950',
                                'in construction' => 'bg-purple-300 text-purple-950',
                                'dispatched' => 'bg-blue-300 text-blue-950',
                                default => 'bg-gray-200 text-gray-900'
                            };
                        @endphp
                        <tr onclick="window.location='{{ route('orders.show', ['orders' => $order->id]) }}'"
                            class="bg-gray-100 border border-gray-200 hover:bg-gray-200 cursor-pointer transition duration-200 ease-in-out rounded-lg">
                            <td class="px-4 py-4 border-t border-b border-l rounded-l-lg font-black">
                                #{{ $order->order_number }}
                            </td>
                            <td class="px-4 py-4 border-t border-b">
                                {{ $order->name }}
                            </td>
                            <td class="px-4 py-4 border-t border-b  ">
                                {{ $order->occasion }}
                            </td>
                            <td class="px-4 py-4 border-t border-b border-r rounded-r-lg">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $badge }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                           
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center text-gray-400 py-8">
            No recent orders found.
        </div>
    @endif
</div>
<!-- ===== /Wide Card ===== -->

<!-- ===== Card 5: Documentation / How to Measure ===== -->
<div class="relative rounded-xl overflow-hidden border border-gray-200 shadow-sm min-h-[260px]">
    <!-- Background image (force behind everything) -->
    <div class="absolute inset-0 -z-10">
        <img
            src="{{ asset('images/reg.jpg') }}"
            alt="Tailored suit close-up"
            class="w-full h-full object-cover select-none pointer-events-none"
            loading="lazy"
        />
        <div class="absolute inset-0 bg-black/50"></div>
    </div>

<!-- ===== Card 5: Documentation / How to Measure ===== -->
<div class="relative rounded-xl overflow-hidden border border-gray-200 shadow-sm min-h-[260px]">
    <!-- Background image (force behind everything) -->
    <div class="absolute inset-0 -z-10">
        <img
            src="{{ asset('images/reg.jpg') }}" {{-- Replace with your actual image --}}
            alt="Tailored suit close-up"
            class="w-full h-full object-cover select-none pointer-events-none"
            loading="lazy"
        />
        <!-- Overlay for readability -->
        <div class="absolute inset-0 bg-black/50"></div>
    </div>

    <!-- Foreground content -->
    <div class="relative z-0 !p-12 md:!p-16 text-white" style="padding:3rem;">
        <h2 class="text-2xl font-bold">Documentation & Fit Guides</h2>
        <p class="mt-2 text-emerald-100">
            Everything you need to measure accurately and submit perfect orders.
        </p>

        <ul class="mt-4 space-y-1 text-sm text-emerald-50 list-disc list-inside">
            <li>Step-by-step measurement guides</li>
            <li>Garment vs. body fit explanations</li>
            <li>Tips to ensure accurate results</li>
        </ul>

        <div class="mt-6 flex flex-wrap gap-3">
            <a href="https://www.deegrahamtailormade.com"
               target="_blank"
               rel="noopener noreferrer"
               class="inline-flex items-center px-6 py-4 rounded-lg border border-white text-white font-semibold
                      bg-transparent hover:bg-white hover:text-emerald-900 hover:border-white transition-all duration-300 ease-in-out shadow-sm">
                Access
            </a>
        </div>
    </div>
</div>
<!-- ===== /Card 5 ===== -->






            </div>
        </div>
    </div>
</x-app-layout>

<!-- Keep scripts OUTSIDE the grid so gap-* works -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js" defer></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // ===== Graph 1: Donut with center label =====
    const donutEl = document.getElementById('ordersStatusChart');
    if (donutEl) {
        if (window._ordersStatusChart) window._ordersStatusChart.destroy();

        const centerLabel = {
            id: 'centerLabel',
            afterDatasetsDraw(chart, args, opts) {
                const meta = chart.getDatasetMeta(0);
                if (!meta || !meta.data || !meta.data.length) return;
                const { x, y } = meta.data[0];
                const ctx = chart.ctx;
                ctx.save();
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillStyle = opts.color || '#ffffff';

                ctx.font = `700 ${opts.fontSize || 28}px ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial`;
                ctx.fillText('{{ $totalOrders }}', x, y - (opts.offsetTop || 6));

                ctx.globalAlpha = 0.9;
                ctx.font = `500 ${opts.subFontSize || 12}px ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial`;
                ctx.fillText(opts.subLabel || 'Total', x, y + (opts.offsetBottom || 16));
                ctx.restore();
            }
        };

        window._ordersStatusChart = new Chart(donutEl, {
            type: 'doughnut',
            data: {
                labels: ['Draft', 'Paid', 'In Construction', 'Dispatched'],
                datasets: [{
                    data: [{{ $draftCount }}, {{ $paidCount }}, {{ $constructionCount }}, {{ $dispatchedCount }}],
                    backgroundColor: ['#9ca3af', '#059669', '#f59e0b', '#3b82f6'],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '72%',
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: true },
                    centerLabel: { color: '#ffffff', fontSize: 28, subFontSize: 12, subLabel: 'Total' }
                },
                animation: { animateRotate: true, animateScale: true }
            },
            plugins: [centerLabel]
        });
    }

    // ===== Graph 2: Bar comparison =====
    const compareEl = document.getElementById('ordersCompareChart');
    if (compareEl) {
        if (window._ordersCompareChart) window._ordersCompareChart.destroy();

        window._ordersCompareChart = new Chart(compareEl, {
            type: 'bar',
            data: {
                labels: ['Previous 30 Days', 'Last 30 Days'],
                datasets: [{
                    label: 'Orders',
                    data: [{{ $previousCount }}, {{ $currentCount }}],
                    backgroundColor: ['#9ca3af', '#032c23'],
                    borderWidth: 0,
                    borderRadius: 10,
                    barPercentage: 0.6,
                    categoryPercentage: 0.6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: { padding: { left: 24, right: 24 } },
                scales: {
                    x: {
                        grid: { drawBorder: false, display: false },
                        ticks: { padding: 8 }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { drawBorder: false },
                        ticks: { precision: 0, padding: 8 }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: true }
                },
                animation: { duration: 700 }
            }
        });
    }
});
</script>



