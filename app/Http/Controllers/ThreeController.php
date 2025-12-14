<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Measurements;
use App\Models\ThreePiece;
use App\Models\OrderOverview;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ThreeController extends Controller
{
    public function index()
    {
        //
    }

    public function create(): View
    {
        $user = Auth::user();
        $id   = request()->route('id');

        $orders       = Orders::where('user_id', $user->id)->findOrFail($id);
        $orderId      = $orders->id;
        $measurements = Measurements::where('order_id', $orderId)->get();

        return view('three.three_form', compact('orders','measurements'));
    }

    public function store(Request $request)
    {
        $user  = Auth::user(); 
        $id    = request()->route('id');
        $price = Price::find(2);

        $created_three_piece = ThreePiece::create([
            'order_id'                                  => $id,
            'user_id'                                   => $user->id,
            'measurement_id'                            => $request->measurement_id,
            'price_id'                                  => 2,
            'jacket_type'                               => $request->jacket_type,
            'jacket_construction'                       => $request->jacket_construction,
            'jacket_lapel_type'                         => $request->jacket_lapel_type,
            'jacket_hand_stitch'                        => $request->jacket_hand_stitch,
            'jacket_satin_lapel'                        => $request->jacket_satin_lapel,
            'jacket_lapel_width'                        => $request->jacket_lapel_width,
            'jacket_lapel_functional_button'            => $request->jacket_lapel_functional_button,
            'jacket_sleeve_buttons'                     => $request->jacket_sleeve_buttons,
            'jacket_functional_buttons'                 => $request->jacket_functional_buttons,
            'jacket_buttons_colour_on_last_button_hole' => $request->jacket_buttons_colour_on_last_button_hole,
            'jacket_lining'                             => $request->jacket_lining,
            'jacket_pockets'                            => $request->jacket_pockets,
            'jacket_pockets_with_flap'                  => $request->jacket_pockets_with_flap,
            'jacket_italian_pockets'                    => $request->jacket_italian_pockets,
            'jacket_patch_pockets'                      => $request->jacket_patch_pockets,
            'jacket_pockets_satin_piping'               => $request->jacket_pockets_satin_piping,
            'jacket_chest_pocket_type'                  => $request->jacket_chest_pocket_type,
            'jacket_vents'                              => $request->jacket_vents,

            'waistcoat_type'                            => $request->waistcoat_type,

            'pants_pocket'                              => $request->pants_pocket,
            'pants_pleats'                              => $request->pants_pleats,
            'pants_extended_waist_strap'                => $request->pants_extended_waist_strap,
            'pants_side_adjusters'                      => $request->pants_side_adjusters,
            'pants_back_pocket_type'                    => $request->pants_back_pocket_type,
            'pants_back_pocket_with_buttons'            => $request->pants_back_pocket_with_buttons,
            'pants_back_pocket_with_flap'               => $request->pants_back_pocket_with_flap,
            'pants_pant_cuffs'                          => $request->pants_pant_cuffs,
            'pants_satin_tape_on_side'                  => $request->pants_satin_tape_on_side,

            'code_jacket'                               => $request->code_jacket,
            'code_jacket_lining'                        => $request->code_jacket_lining,
            'code_jacket_button'                        => $request->code_jacket_button,
            'code_satin_lapel'                          => $request->code_satin_lapel,
            'code_colour_on_last_button_hole'           => $request->code_colour_on_last_button_hole,

            'code_waistcoat'                            => $request->code_waistcoat,
            'code_waistcoat_buttons'                    => $request->code_waistcoat_buttons,

            'code_pants'                                => $request->code_pants,
            'code_pants_button'                         => $request->code_pants_button,
        ]);

        OrderOverview::create([
            'order_id'        => $id,
            'user_id'         => $user->id,
            'measurement_id'  => $request->measurement_id,
            'price_id'        => 2,
            'two_pieces_id'   => null,
            'three_pieces_id' => $created_three_piece->id,
            'jackets_id'      => null,
            'shirts_id'       => null,
            'trouser_id'      => null,
            'waistcoat_id'    => null,
            'type'            => '3 Piece',
            'for'             => $request->measurement_id,
            'price'           => $price?->price ?? 0,
            'status'          => 'draft',
        ]);
        
        // ⭐ ROLE-BASED REDIRECT
        $routeName = in_array($user->role, ['admin', 'super'])
            ? 'admin.orders.show'
            : 'orders.show';

        return redirect()
            ->route($routeName, ['orders' => $id])
            ->with('success', '3 Piece created successfully.');
    }

    public function show(Orders $orders)
    {
        //
    }

    public function edit(Orders $orders)
    {
        //
    }

    public function update(Request $request, ThreePiece $three)
    {
        $validated = $request->validate([
            'measurement_id' => 'required|integer',

            // Jacket options
            'jacket_type'                               => 'nullable|string',
            'jacket_construction'                       => 'nullable|string',
            'jacket_lapel_type'                         => 'nullable|string',
            'jacket_hand_stitch'                        => 'nullable|string',
            'jacket_satin_lapel'                        => 'nullable|string',
            'jacket_lapel_width'                        => 'nullable|string',
            'jacket_lapel_functional_button'            => 'nullable|string',
            'jacket_sleeve_buttons'                     => 'nullable|string',
            'jacket_functional_buttons'                 => 'nullable|string',
            'jacket_buttons_colour_on_last_button_hole' => 'nullable|string',
            'jacket_lining'                             => 'nullable|string',
            'jacket_pockets'                            => 'nullable|string',
            'jacket_pockets_with_flap'                  => 'nullable|string',
            'jacket_italian_pockets'                    => 'nullable|string',
            'jacket_patch_pockets'                      => 'nullable|string',
            'jacket_pockets_satin_piping'               => 'nullable|string',
            'jacket_chest_pocket_type'                  => 'nullable|string',
            'jacket_vents'                              => 'nullable|string',

            // Codes
            'code_jacket'                               => 'nullable|string|regex:/^[A-Za-z0-9]+$/',
            'code_jacket_lining'                        => 'nullable|string|regex:/^[A-Za-z0-9]+$/',
            'code_jacket_button'                        => 'nullable|string|regex:/^[A-Za-z0-9]+$/',
            'code_satin_lapel'                          => 'nullable|string|regex:/^[A-Za-z0-9]+$/',
            'code_colour_on_last_button_hole'           => 'nullable|string|regex:/^[A-Za-z0-9]+$/',

            // Waistcoat
            'waistcoat_type'                            => 'nullable|string',
            'code_waistcoat'                            => 'nullable|string|regex:/^[A-Za-z0-9]+$/',
            'code_waistcoat_buttons'                    => 'nullable|string|regex:/^[A-Za-z0-9]+$/',

            // Pants
            'pants_pocket'                              => 'nullable|string',
            'pants_extended_waist_strap'                => 'nullable|string',
            'pants_pleats'                              => 'nullable|string',
            'pants_back_pocket_type'                    => 'nullable|string',
            'pants_back_pocket_with_buttons'            => 'nullable|string',
            'pants_back_pocket_with_flap'               => 'nullable|string',
            'pants_pant_cuffs'                          => 'nullable|string',
            'pants_side_adjusters'                      => 'nullable|string',
            'pants_satin_tape_on_side'                  => 'nullable|string',
            'code_pants'                                => 'nullable|string|regex:/^[A-Za-z0-9]+$/',
            'code_pants_button'                         => 'nullable|string|regex:/^[A-Za-z0-9]+$/',
        ]);

        $three->update(array_merge($validated, [
            'price_id' => 2, 
        ]));

        $user    = Auth::user();
        $orderId = $three->order_id;

        // ⭐ ROLE-BASED REDIRECT
        $routeName = in_array($user->role, ['admin', 'super'])
            ? 'admin.orders.show'
            : 'orders.show';

        return redirect()
            ->route($routeName, ['orders' => $orderId])
            ->with('success', '3 Piece updated successfully.');
    }

    public function destroy(Orders $orders)
    {
        //
    }
}
