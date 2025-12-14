<?php

namespace App\Http\Controllers;

use App\Models\Shirt;
use App\Models\TwoPiece;
use App\Models\ThreePiece;
use App\Models\Jacket;
use App\Models\Orders;
use App\Models\Measurements;
use App\Models\OrderOverview;
use Illuminate\Http\Request;
use App\Jobs\GenerateAndEmailOrderZip;

class OrdersActionController extends Controller
{
    public function send(Request $request, Orders $order)
    {
        // We already have admin middleware on the route, so no extra authorize() needed

        // Validate prerequisites: at least one item and one measurement
        $order->load(['orderOverviews', 'measurements']);
        if ($order->orderOverviews->count() === 0 || $order->measurements->count() === 0) {
            return back()->with('Unsuccessful', 'You need at least one item and one measurement to send.');
        }

        // Set order + items to in construction (optional but recommended)
        foreach ($order->orderOverviews as $item) {
            $item->status = 'in construction';
            $item->save();
        }

        $order->status = 'in construction';
        $order->save();

        // Queue job to generate PDFs, zip, and email factory
        GenerateAndEmailOrderZip::dispatch($order->id);

        return back()->with('success', 'Order sent to factory. PDFs will be generated and emailed shortly.');
    }

    public function markAsDispatched(Request $request, Orders $order)
    {
        // No $this->authorize() – route is already protected by can:access-admin

        // Optional: only allow if it's currently "in construction"
        if (strtolower(trim($order->status)) !== 'in construction') {
            return back()->with('Unsuccessful', 'Only orders that are In Construction can be marked as dispatched.');
        }

        // Load items
        $order->load('orderOverviews');

        // Update each item status
        foreach ($order->orderOverviews as $item) {
            $item->status = 'dispatched';
            $item->save();
        }

        // Update the main order
        $order->status = 'dispatched';
        $order->save();

        return back()->with('success', 'Order and items marked as dispatched.');
    }

    public function destroy(Request $request, Orders $order)
    {
        // No $this->authorize() – admin middleware is already in place

        $order->delete();

        return redirect()
            ->route('admin.orders.index')   // note: admin prefix
            ->with('success', 'Order deleted.');
    }
}
