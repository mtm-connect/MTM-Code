<?php

namespace App\Http\Controllers;

use App\Models\Shirt;
use App\Models\TwoPiece;
use App\Models\ThreePiece;
use App\Models\Jacket;
use App\Models\Orders;
use App\Models\Waistcoat;
use App\Models\Measurements;
use App\Models\OrderOverview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
     

        $user = auth()->user();



        return view('account.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {

    }

    public function show(Orders $orders)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders, OrderOverview $orderoverview, Measurements $measurement)
    {

    }

    public function view(Orders $orders, OrderOverview $orderoverview, Measurements $measurement)
    {

    }

    public function update(Request $request)
    {
        $user = $request->user();

        // All fields optional so untouched ones stay as-is
        $validated = $request->validate([
            'name'            => ['nullable', 'string', 'max:255'],
            'company'         => ['nullable', 'string', 'max:255'],
            'email'           => ['nullable', 'email', 'max:255'],
            'phone_number'    => ['nullable', 'string', 'max:50'],
            'country'         => ['nullable', 'in:IE,GB,US'],
            'address_line_1'  => ['nullable', 'string', 'max:255'],
            'address_line_2'  => ['nullable', 'string', 'max:255'],
            'post_code'       => ['nullable', 'string', 'max:30'],
            'county'          => ['nullable', 'string', 'max:255'],
        ]);

        // Only update non-empty fields
        $toUpdate = array_filter($validated, fn ($v) => !is_null($v) && $v !== '');

        if (!empty($toUpdate)) {
            $user->update($toUpdate);
        }

        return back()->with('success', 'Your account details have been updated successfully.');
    }

    public function destroy(Orders $orders)
    {
        //
    }
}
