<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Measurements;
use App\Models\Jacket;             // ✅ fixed
use App\Models\OrderOverview;      // ✅ fixed
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class JacketController extends Controller
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

        return view('jacket.jacket_form', compact('orders', 'measurements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user  = Auth::user();
        $id    = request()->route('id');
        $price = Price::find(3);

        $created_jacket = Jacket::create([   // ✅ fixed
            'order_id'                                   => $id,
            'user_id'                                    => $user->id,
            'measurement_id'                             => $request->measurement_id,
            'price_id'                                   => '3',
            'jacket_type'                                => $request->jacket_type,
            'jacket_construction'                        => $request->jacket_construction,
            'jacket_lapel_type'                          => $request->jacket_lapel_type,
            'jacket_hand_stitch'                         => $request->jacket_hand_stitch,
            'jacket_satin_lapel'                         => $request->jacket_satin_lapel,
            'jacket_lapel_width'                         => $request->jacket_lapel_width,
            'jacket_lapel_functional_button'             => $request->jacket_lapel_functional_button,
            'jacket_sleeve_buttons'                      => $request->jacket_sleeve_buttons,
            'jacket_functional_buttons'                  => $request->jacket_functional_buttons,
            'jacket_buttons_colour_on_last_button_hole'  => $request->jacket_buttons_colour_on_last_button_hole,
            'jacket_lining'                              => $request->jacket_lining,
            'jacket_pockets'                             => $request->jacket_pockets,
            'jacket_pockets_with_flap'                   => $request->jacket_pockets_with_flap,
            'jacket_italian_pockets'                     => $request->jacket_italian_pockets,
            'jacket_patch_pockets'                       => $request->jacket_patch_pockets,
            'jacket_pockets_satin_piping'                => $request->jacket_pockets_satin_piping,
            'jacket_chest_pocket_type'                   => $request->jacket_chest_pocket_type,
            'jacket_vents'                               => $request->jacket_vents,
            'code_jacket'                                => $request->code_jacket,
            'code_jacket_lining'                         => $request->code_jacket_lining,
            'code_jacket_button'                         => $request->code_jacket_button,
            'code_satin_lapel'                           => $request->code_satin_lapel,
            'code_colour_on_last_button_hole'            => $request->code_colour_on_last_button_hole,
        ]);

        OrderOverview::create([   // ✅ fixed
            'order_id'       => $id,
            'user_id'        => $user->id,
            'measurement_id' => $request->measurement_id,
            'price_id'       => '3',
            'two_pieces_id'  => null,
            'three_pieces_id'=> null,
            'jackets_id'     => $created_jacket->id,
            'shirts_id'      => null,
            'trouser_id'     => null,
            'waistcoat_id'   => null,
            'type'           => 'Jacket',
            'for'            => $request->measurement_id,
            'price'          => $price?->price ?? 0,
            'status'         => 'draft',
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
    public function update(Request $request, Jacket $jacket)
    {
        // Validate request data
        $validated = $request->validate([
            'measurement_id'                              => 'required|integer',
            'jacket_type'                                 => 'nullable|string',
            'jacket_construction'                         => 'nullable|string',
            'jacket_lapel_type'                           => 'nullable|string',
            'jacket_hand_stitch'                          => 'nullable|string',
            'jacket_satin_lapel'                          => 'nullable|string',
            'jacket_lapel_width'                          => 'nullable|string',
            'jacket_lapel_functional_button'              => 'nullable|string',
            'jacket_sleeve_buttons'                       => 'nullable|string',
            'jacket_functional_buttons'                   => 'nullable|string',
            'jacket_buttons_colour_on_last_button_hole'   => 'nullable|string',
            'jacket_lining'                               => 'nullable|string',
            'jacket_pockets'                              => 'nullable|string',
            'jacket_pockets_with_flap'                    => 'nullable|string',
            'jacket_italian_pockets'                      => 'nullable|string',
            'jacket_patch_pockets'                        => 'nullable|string',
            'jacket_pockets_satin_piping'                 => 'nullable|string',
            'jacket_chest_pocket_type'                    => 'nullable|string',
            'jacket_vents'                                => 'nullable|string',
            'code_jacket'                                 => 'nullable|string',
            'code_jacket_lining'                          => 'nullable|string',
            'code_jacket_button'                          => 'nullable|string',
            'code_satin_lapel'                            => 'nullable|string',
            'code_colour_on_last_button_hole'             => 'nullable|string',
        ]);

        // Update the jacket record
        $jacket->update(array_merge($validated, [
            'price_id' => 3, // keep synced with your Price row
        ]));

        return redirect()
            ->route('orders.show', ['orders' => $jacket->order_id])
            ->with('success', 'Jacket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
