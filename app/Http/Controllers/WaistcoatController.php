<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Measurements;
use App\Models\Waistcoat;
use App\Models\OrderOverview;   // ✅ renamed model
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class WaistcoatController extends Controller
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

        return view('waistcoat.waistcoat_form', compact('orders','measurements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user  = Auth::user();
        $id    = request()->route('id');
        $price = Price::find(6);

        $created_waistcoat = Waistcoat::create([
            'order_id'              => $id,
            'user_id'               => $user->id,
            'measurement_id'        => $request->measurement_id,
            'price_id'              => '6',
            'waistcoat_type'        => $request->waistcoat_type,
            'code_waistcoat'        => $request->code_waistcoat,
            'code_waistcoat_buttons'=> $request->code_waistcoat_buttons,
        ]);

        OrderOverview::create([
            'order_id'        => $id,
            'user_id'         => $user->id,
            'measurement_id'  => $request->measurement_id,
            'price_id'        => '6',
            'two_pieces_id'   => null,
            'three_pieces_id' => null,
            'jackets_id'      => null,
            'shirts_id'       => null,
            'trouser_id'      => null,
            'waistcoat_id'    => $created_waistcoat->id,
            'type'            => 'Waistcoat',
            'for'             => $request->measurement_id,
            'price'           => $price?->price ?? 0,
            'status'          => 'draft',
        ]);
        
        return redirect()->route('orders.show', ['orders' => $id]);
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
    public function update(Request $request, Waistcoat $waistcoat)
    {
        $validated = $request->validate([
            'measurement_id'        => 'required|integer',
            'waistcoat_type'        => 'nullable|string',
            'code_waistcoat'        => 'nullable|string',
            'code_waistcoat_buttons'=> 'nullable|string',
        ]);

        $waistcoat->update(array_merge($validated, [
            'price_id' => 6,
        ]));

        return redirect()
            ->route('orders.show', ['orders' => $waistcoat->order_id])
            ->with('success', 'Waistcoat updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
