<?php

namespace App\Http\Controllers;

use App\Models\Shirt;
use App\Models\TwoPiece;
use App\Models\ThreePiece;
use App\Models\Jacket;
use App\Models\Orders;
use App\Models\Measurements;
use App\Models\OrderOverview; // renamed model
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Jobs\GenerateAndEmailOrderZip;

class OrdersActionController extends Controller
{
    public function send(Request $request, Orders $order)
    {
        $this->authorize('update', $order); // optional if using policies

        // Validate prerequisites: at least one item and one measurement
        $order->load(['orderOverviews', 'measurements']);
        if ($order->orderOverviews->count() === 0 || $order->measurements->count() === 0) {
            return back()->with('Unsuccessful', 'You need at least one item and one measurement to send.');
        }

        // 1 & 2) Mark status -> in construction
        $order->status = 'in construction';
        $order->save();

        // 3 & 4) Queue job to generate PDFs, zip, and email factory
        GenerateAndEmailOrderZip::dispatch($order->id);

        return back()->with('success', 'Order sent to factory. PDFs will be generated and emailed shortly.');
    }

    public function markAsDispatched(Request $request, Orders $order)
    {
        $this->authorize('update', $order);
        $order->status = 'dispatched';
        $order->save();

        return back()->with('success', 'Order marked as dispatched.');
    }

    public function destroy(Request $request, Orders $order)
    {
        $this->authorize('delete', $order);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted.');
    }
}

