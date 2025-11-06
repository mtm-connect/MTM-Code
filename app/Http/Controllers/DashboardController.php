<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Orders;
use App\Models\OrderOverview;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // ===== Order Status Counts (for donut chart) =====
        $draftCount = Orders::where('user_id', $userId)->where('status', 'draft')->count();
        $paidCount = Orders::where('user_id', $userId)->where('status', 'paid')->count();
        $constructionCount = Orders::where('user_id', $userId)->where('status', 'in construction')->count(); // adjust if DB uses 'in_construction'
        $dispatchedCount = Orders::where('user_id', $userId)->where('status', 'dispatched')->count();

        // ===== 30-Day Comparison (current vs previous) =====
        $now           = Carbon::now();
        $startCurrent  = $now->copy()->subDays(30);
        $startPrevious = $now->copy()->subDays(60);
        $endPrevious   = $now->copy()->subDays(30);

        $currentCount = Orders::where('user_id', $userId)
            ->whereBetween('created_at', [$startCurrent, $now])
            ->count();

        $previousCount = Orders::where('user_id', $userId)
            ->whereBetween('created_at', [$startPrevious, $endPrevious])
            ->count();

        $percentageChange = $previousCount > 0
            ? (($currentCount - $previousCount) / $previousCount) * 100
            : ($currentCount > 0 ? 100 : 0);

        // ===== Total amount spent in last 30 days =====
        $last30TotalAmount = DB::table('order_overview')
            ->join('orders', 'order_overview.order_id', '=', 'orders.id')
            ->where('orders.user_id', $userId)
            ->where('order_overview.created_at', '>=', $startCurrent)
            ->sum('order_overview.price');

        // ===== Most recent 3 orders (for wide card table) =====
        $recentOrders = Orders::where('user_id', $userId)
            ->latest()
            ->take(3)
            ->get(['order_number', 'status', 'name', 'occasion', 'id']);

        return view('dashboard', compact(
            'draftCount',
            'paidCount',
            'constructionCount',
            'dispatchedCount',
            'currentCount',
            'previousCount',
            'percentageChange',
            'last30TotalAmount',
            'recentOrders'
        ));
    }
}
