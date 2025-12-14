<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;

class PricesController extends Controller
{
  

    /**
     * Show the form to edit all prices.
     */
    public function edit()
    {

        if (! in_array(auth()->user()->role, ['super'])) {
            abort(403);
        }
        
        // Get all prices (2 Piece, 3 Piece, Jacket, etc.)
        $prices = Price::orderBy('id')->get();

        // Use whatever path you saved the Blade file as
        return view('prices_edit', compact('prices'));
    }

    /**
     * Update all prices.
     */
    public function update(Request $request)
    {
        // Validate the incoming array of prices
        $validated = $request->validate([
            'prices'   => ['required', 'array'],
            'prices.*' => ['required', 'numeric', 'min:0'],
        ]);

        foreach ($validated['prices'] as $id => $value) {
            Price::where('id', $id)->update([
                'price' => $value,
            ]);
        }

        return back()->with('status', 'Prices updated successfully!');
    }
}
