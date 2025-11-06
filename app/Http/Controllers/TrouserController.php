<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Measurements;
use App\Models\Trouser;            // ✅ correct model
use App\Models\OrderOverview;      // ✅ renamed model
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class TrouserController extends Controller
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

        return view('trouser.trouser', compact('orders', 'measurements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user  = Auth::user();
        $id    = request()->route('id');
        $price = Price::find(5);

        $created_trouser = Trouser::create([
            'order_id'                           => $id,
            'user_id'                            => $user->id,
            'measurement_id'                     => $request->measurement_id,
            'price_id'                           => '5',
            'pants_pocket'                       => $request->pants_pocket,
            'pants_pleats'                       => $request->pants_pleats,
            'pants_extended_waist_strap'         => $request->pants_extended_waist_strap,
            'pants_side_adjusters'               => $request->pants_side_adjusters,
            'pants_back_pocket_type'             => $request->pants_back_pocket_type,
            'pants_back_pocket_with_buttons'     => $request->pants_back_pocket_with_buttons,
            'pants_back_pocket_with_flap'        => $request->pants_back_pocket_with_flap,
            'pants_pant_cuffs'                   => $request->pants_pant_cuffs,
            'pants_satin_tape_on_side'           => $request->pants_satin_tape_on_side,
            'code_pants'                         => $request->code_pants,
            'code_pants_button'                  => $request->code_pants_button,
        ]);

        OrderOverview::create([
            'order_id'         => $id,
            'user_id'          => $user->id,
            'measurement_id'   => $request->measurement_id,
            'price_id'         => '5',
            'two_pieces_id'    => null,
            'three_pieces_id'  => null,
            'jackets_id'       => null,
            'shirts_id'        => null,
            'trouser_id'       => $created_trouser->id,
            'waistcoat_id'     => null,
            'type'             => 'Trousers',
            'for'              => $request->measurement_id,
            'price'            => $price?->price ?? 0,
            'status'           => 'draft',
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
    public function update(Request $request, Trouser $trouser) // ✅ fixed type-hint & var
    {
        // Validate request data
        $validated = $request->validate([
            'measurement_id'                 => 'required|integer',

            'pants_pocket'                   => 'nullable|string',
            'pants_extended_waist_strap'     => 'nullable|string',
            'pants_pleats'                   => 'nullable|string',
            'pants_back_pocket_type'         => 'nullable|string',
            'pants_back_pocket_with_buttons' => 'nullable|string',
            'pants_back_pocket_with_flap'    => 'nullable|string',
            'pants_pant_cuffs'               => 'nullable|string',
            'pants_side_adjusters'           => 'nullable|string',
            'pants_satin_tape_on_side'       => 'nullable|string',

            'code_pants'                     => 'nullable|string|regex:/^[A-Za-z0-9]+$/',
            'code_pants_button'              => 'nullable|string|regex:/^[A-Za-z0-9]+$/',
        ]);

        $trouser->update(array_merge($validated, [
            'price_id' => 5,
        ]));

        return redirect()
            ->route('orders.show', ['orders' => $trouser->order_id])
            ->with('success', 'Trouser updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
