<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Measurements;
use App\Models\Shirt;              // ✅ fixed
use App\Models\OrderOverview;      // ✅ fixed
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ShirtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $user = Auth::user();
        $id   = request()->route('id');

        // Retrieve the order by ID for the authenticated user
        $orders       = Orders::where('user_id', $user->id)->findOrFail($id);
        $orderId      = $orders->id;
        $measurements = Measurements::where('order_id', $orderId)->get();

        return view('shirt.shirt_form', compact('orders', 'measurements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user  = Auth::user();
        $id    = request()->route('id');
        $price = Price::find(4);

        $created_shirt = Shirt::create([     // ✅ fixed
            'order_id'            => $id,
            'user_id'             => $user->id,
            'measurement_id'      => $request->measurement_id,
            'price_id'            => '4',
            'collar'              => $request->collar,
            'collar_buttons'      => $request->collar_buttons,
            'collar_button_down'  => $request->collar_button_down,
            'cuff'                => $request->cuff,
            'contrast'            => $request->contrast,
            'placket'             => $request->placket,
            'pleat'               => $request->pleat,
            'bottom'              => $request->bottom,
            'pocket'              => $request->pocket,
            'fit'                 => $request->fit,
            'shirt_fabric_code'   => $request->shirt_fabric_code,
            'shirt_button_code'   => $request->shirt_button_code,
            'shirt_contrast_code' => $request->shirt_contrast_code,
        ]);

        OrderOverview::create([             // ✅ fixed
            'order_id'        => $id,
            'user_id'         => $user->id,
            'measurement_id'  => $request->measurement_id,
            'price_id'        => '4',
            'two_pieces_id'   => null,
            'three_pieces_id' => null,
            'jackets_id'      => null,
            'shirts_id'       => $created_shirt->id,
            'trouser_id'      => null,
            'waistcoat_id'    => null,
            'type'            => 'Shirt',
            'for'             => $request->measurement_id,
            'price'           => $price?->price ?? 0,
            'status'          => 'draft',
        ]);
        
        return redirect(route('orders.show', ['orders' => $id]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shirt $shirt) // ✅ type-hint uses Shirt
    {
        // Validate request data
        $validated = $request->validate([
            'measurement_id'      => 'required|integer',
            'collar'              => 'nullable|string',
            'collar_buttons'      => 'nullable|string',
            'collar_button_down'  => 'nullable|string',
            'cuff'                => 'nullable|string',
            'contrast'            => 'nullable|string',
            'placket'             => 'nullable|string',
            'pleat'               => 'nullable|string',
            'bottom'              => 'nullable|string',
            'pocket'              => 'nullable|string',
            'fit'                 => 'nullable|string',
            'shirt_fabric_code'   => 'nullable|string',
            'shirt_button_code'   => 'nullable|string',
            'shirt_contrast_code' => 'nullable|string',
        ]);

        // Update the shirt record
        $shirt->update(array_merge($validated, [
            'price_id' => 4,
        ]));

        return redirect()
            ->route('orders.show', ['orders' => $shirt->order_id])
            ->with('success', 'Shirt updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
