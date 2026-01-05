<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Measurements;
use App\Models\Overcoat;           // ✅
use App\Models\OrderOverview;      // ✅
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class OvercoatController extends Controller
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

        return view('overcoat.overcoat_form', compact('orders', 'measurements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user  = Auth::user();
        $id    = request()->route('id');

        // ⚠️ Change this if your Overcoat price row has a different ID
        $price = Price::find(7);

        $created_overcoat = Overcoat::create([
            'order_id'                                    => $id,
            'user_id'                                     => $user->id,
            'measurement_id'                              => $request->measurement_id,
            'price_id'                                    => '7',

            'overcoat_type'                               => $request->overcoat_type,
            'overcoat_construction'                       => $request->overcoat_construction,
            'overcoat_lapel_type'                         => $request->overcoat_lapel_type,
            'overcoat_hand_stitch'                        => $request->overcoat_hand_stitch,
            'overcoat_satin_lapel'                        => $request->overcoat_satin_lapel,
            'overcoat_lapel_width'                        => $request->overcoat_lapel_width,
            'overcoat_lapel_functional_button'            => $request->overcoat_lapel_functional_button,
            'overcoat_sleeve_buttons'                     => $request->overcoat_sleeve_buttons,
            'overcoat_functional_buttons'                 => $request->overcoat_functional_buttons,
            'overcoat_buttons_colour_on_last_button_hole' => $request->overcoat_buttons_colour_on_last_button_hole,
            'overcoat_lining'                             => $request->overcoat_lining,
            'overcoat_pockets'                            => $request->overcoat_pockets,
            'overcoat_pockets_with_flap'                  => $request->overcoat_pockets_with_flap,
            'overcoat_italian_pockets'                    => $request->overcoat_italian_pockets,
            'overcoat_patch_pockets'                      => $request->overcoat_patch_pockets,
            'overcoat_pockets_satin_piping'               => $request->overcoat_pockets_satin_piping,
            'overcoat_chest_pocket_type'                  => $request->overcoat_chest_pocket_type,
            'overcoat_vents'                              => $request->overcoat_vents,

            'code_overcoat'                               => $request->code_overcoat,
            'code_overcoat_lining'                        => $request->code_overcoat_lining,
            'code_overcoat_button'                        => $request->code_overcoat_button,
            'code_satin_lapel'                            => $request->code_satin_lapel,
            'code_colour_on_last_button_hole'             => $request->code_colour_on_last_button_hole,
        ]);

        OrderOverview::create([
            'order_id'        => $id,
            'user_id'         => $user->id,
            'measurement_id'  => $request->measurement_id,
            'price_id'        => '7',
            'two_pieces_id'   => null,
            'three_pieces_id' => null,
            'jackets_id'      => null,
            'shirts_id'       => null,
            'trouser_id'      => null,
            'waistcoat_id'    => null,
            'overcoat_id'     => $created_overcoat->id, // ✅ new
            'type'            => 'Overcoat',
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
    public function update(Request $request, Overcoat $overcoat)
    {
        $validated = $request->validate([
            'measurement_id'                               => 'required|integer',
            'overcoat_type'                                => 'nullable|string',
            'overcoat_construction'                        => 'nullable|string',
            'overcoat_lapel_type'                          => 'nullable|string',
            'overcoat_hand_stitch'                         => 'nullable|string',
            'overcoat_satin_lapel'                         => 'nullable|string',
            'overcoat_lapel_width'                         => 'nullable|string',
            'overcoat_lapel_functional_button'             => 'nullable|string',
            'overcoat_sleeve_buttons'                      => 'nullable|string',
            'overcoat_functional_buttons'                  => 'nullable|string',
            'overcoat_buttons_colour_on_last_button_hole'  => 'nullable|string',
            'overcoat_lining'                              => 'nullable|string',
            'overcoat_pockets'                             => 'nullable|string',
            'overcoat_pockets_with_flap'                   => 'nullable|string',
            'overcoat_italian_pockets'                     => 'nullable|string',
            'overcoat_patch_pockets'                       => 'nullable|string',
            'overcoat_pockets_satin_piping'                => 'nullable|string',
            'overcoat_chest_pocket_type'                   => 'nullable|string',
            'overcoat_vents'                               => 'nullable|string',
            'code_overcoat'                                => 'nullable|string',
            'code_overcoat_lining'                         => 'nullable|string',
            'code_overcoat_button'                         => 'nullable|string',
            'code_satin_lapel'                             => 'nullable|string',
            'code_colour_on_last_button_hole'              => 'nullable|string',
        ]);

        $overcoat->update(array_merge($validated, [
            'price_id' => 7,
        ]));

        $user    = Auth::user();
        $orderId = $overcoat->order_id;

        // 👇 choose route based on role
        $routeName = in_array($user->role, ['admin', 'super'])
            ? 'admin.orders.show'
            : 'orders.show';

        return redirect()
            ->route($routeName, ['orders' => $orderId])
            ->with('success', 'Overcoat updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
