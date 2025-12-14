<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Orders;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $clientsQuery = User::query()
            ->where('role', 'user')
            ->withCount('orders')
            ->orderBy('company', 'asc');

        if ($search) {
            $clientsQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        $clients = $clientsQuery->paginate(25)->withQueryString();

        return view('admin.clients.index', compact('clients'));
    }

    public function show(User $client)
    {
        // Get all orders for this client, with their items (orderOverviews)
        $orders = Orders::with('orderOverviews')
            ->where('user_id', $client->id)
            ->orderByDesc('created_at')
            ->get();

        $ordersCount = $orders->count();

        // Total spent across all orders
        $totalSpent = $orders->sum(function ($order) {
            return $order->orderOverviews->sum('price');
        });

        // Total spent in last 30 days
        $cutoff = now()->subDays(30);
        $totalSpentLast30 = $orders
            ->where('created_at', '>=', $cutoff)
            ->sum(function ($order) {
                return $order->orderOverviews->sum('price');
            });

        return view('admin.clients.show', [
            'client'            => $client,
            'orders'            => $orders,
            'ordersCount'       => $ordersCount,
            'totalSpent'        => $totalSpent,
            'totalSpentLast30'  => $totalSpentLast30,
        ]);
    }

    public function updateSubscription(Request $request, User $client)
    {
        $request->validate([
            'subscription' => 'required|string|max:255',
        ]);

        $client->subscription = $request->subscription;
        $client->save();

        return redirect()
            ->route('admin.clients.show', $client)
            ->with('success', 'Subscription updated successfully.');
    }
}
