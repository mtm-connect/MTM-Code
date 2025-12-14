<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        if (! in_array(auth()->user()->role, ['admin', 'super'])) {
            abort(403);
        }
    
        // ===== Global order status counts =====
        $draftCount        = Orders::where('status', 'draft')->count();
        $paidCount         = Orders::where('status', 'paid')->count();
        $constructionCount = Orders::where('status', 'in construction')->count();
        $dispatchedCount   = Orders::where('status', 'dispatched')->count();
    
        $now = now();
    
        // ===== Total Revenue (Last 30 Days) =====
        $last30TotalRevenue = \App\Models\OrderOverview::join('orders', 'order_overview.order_id', '=', 'orders.id')
            ->where('orders.created_at', '>=', $now->copy()->subDays(30))
            ->sum('order_overview.price');
    
        // ===== Last 30 vs Previous 30 (orders count) =====
        $currentCount = Orders::where('created_at', '>=', $now->copy()->subDays(30))->count();
    
        $previousCount = Orders::whereBetween('created_at', [
            $now->copy()->subDays(60),
            $now->copy()->subDays(30),
        ])->count();
    
        // Recent orders
        $recentOrders = Orders::orderByDesc('created_at')->take(5)->get();

        // ===== Total Revenue (All Time) =====
$totalRevenue = \App\Models\OrderOverview::sum('price');

    
        return view('admin.dashboard', compact(
            'draftCount',
            'paidCount',
            'constructionCount',
            'dispatchedCount',
            'currentCount',
            'previousCount',
            'recentOrders',
            'last30TotalRevenue',
            'totalRevenue'
        ));
    }
    
}
