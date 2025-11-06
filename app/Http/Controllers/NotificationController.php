<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function indexJson(Request $request)
    {
        $user = $request->user();

        $items = $user->notifications()
            ->latest()
            ->take(30)
            ->get()
            ->map(fn($n) => [
                'id'       => $n->id,
                'title'    => $n->data['title'] ?? 'Notification',
                'message'  => $n->data['message'] ?? '',
                'orderId'  => $n->data['order_id'] ?? null,
                'status'   => $n->data['status'] ?? null,
                'read'     => !is_null($n->read_at),
                'time'     => $n->created_at->diffForHumans(),
                'created'  => $n->created_at->toIso8601String(),
            ]);

        return response()->json([
            'unreadCount' => $user->unreadNotifications()->count(),
            'items'       => $items,
        ]);
    }

    public function markRead(Request $request, string $id)
    {
        $n = $request->user()->notifications()->where('id', $id)->firstOrFail();
        if (!$n->read_at) $n->markAsRead();
        return response()->json(['ok' => true]);
    }

    public function markAllRead(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();
        return response()->json(['ok' => true]);
    }

    public function unreadCount(Request $request)
    {
        return response()->json([
            'unreadCount' => $request->user()->unreadNotifications()->count()
        ]);
    }
}
