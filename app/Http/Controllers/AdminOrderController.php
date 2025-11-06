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

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (! in_array(auth()->user()->role, ['admin','super'])) {
            abort(403);
        }
    
        // Get filter inputs
        $search = $request->input('search');
        $status = $request->input('status');
        $sort   = $request->input('sort', 'desc'); // 'desc' or 'asc'
    
        $orders = Orders::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('id', 'LIKE', "%{$search}%")
                      ->orWhere('name', 'LIKE', "%{$search}%");
                });
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            // Non-drafts first, drafts last (primary sort)
            ->orderByRaw("CASE WHEN status = 'draft' THEN 1 ELSE 0 END ASC")
            // Then apply your chosen date sort within each group
            ->orderBy('created_at', $sort)
            ->get();
    
        return view('admin.admin_orders', compact('orders', 'search', 'status', 'sort'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('neworder');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user(); 
     
        Orders::create([
            'user_id'        => $user->id,
            'name'           => $request->name,
            'phone_number'   => $request->phone_number,
            'email'          => $request->email,
            'country'        => $request->country,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'post_code'      => $request->post_code,
            'county'         => $request->county,
            'occasion'       => $request->occasion,
            'date_required'  => $request->date_required,
            'status'         => 'draft',
        ]);
    
        return redirect(route('orders.index', absolute: false));
    }

    public function show(Orders $orders)
    {
        $orderId = $orders->id;
    
        // If you use virtual item_number on OrderOverview, eager-load related items:
        $orderOverviews = OrderOverview::with([
            'jacket:id,item_number',
            'shirt:id,item_number',
            'twoPiece:id,item_number',
            'threePiece:id,item_number',
            'trouser:id,item_number',
            'waistcoat:id,item_number',
        ])->where('order_id', $orderId)->get();
    
        $measurements = Measurements::where('order_id', $orderId)->get();
    
        $totalPrice = $orderOverviews->sum('price');

        return view('admin.order_dashboard', compact('orders', 'measurements', 'orderOverviews', 'totalPrice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders, OrderOverview $orderoverview, Measurements $measurement)
    {
        $orderId = $orders->id;
    
        $orderOverviews = OrderOverview::where('id', $orderoverview->id)->first();

        $measurements = Measurements::where('order_id', $orderId)->get();

        $selectedmeasurement = Measurements::where('id', $measurement->id)->first();
    
        // Fetch selected item records (guard against null fks)
        $selectedjacket      = $orderoverview->jackets_id      ? Jacket::find($orderoverview->jackets_id)        : null;
        $selected_twopiece   = $orderoverview->two_pieces_id   ? TwoPiece::find($orderoverview->two_pieces_id)   : null;
        $selected_threepiece = $orderoverview->three_pieces_id ? ThreePiece::find($orderoverview->three_pieces_id) : null;
        $selectedshirt       = $orderoverview->shirts_id       ? Shirt::find($orderoverview->shirts_id)          : null;
   
        if (!$orderOverviews) {
            return redirect()->back()->with('error', 'Order overview not found.');
        }
    
        $orderType = $orderOverviews->type;

        switch ($orderType) {
            case 'Jacket':
                return view('orders.jacket_edit', compact('orders', 'orderOverviews', 'measurements','selectedmeasurement','selectedjacket'));

            case 'Shirt':
                return view('orders.shirt_edit', compact('orders', 'orderOverviews', 'measurements','selectedmeasurement','selectedshirt'));

            case '2 Piece':
                return view('orders.twopiece_edit', compact('orders', 'orderOverviews', 'measurements','selectedmeasurement','selected_twopiece'));

            case '3 Piece':
                return view('orders.threepiece_edit', compact('orders', 'orderOverviews', 'measurements','selectedmeasurement','selected_threepiece'));
        }

        abort(404);
    }

    public function view(Orders $orders, OrderOverview $orderoverview, Measurements $measurement)
    {
        $orderId = $orders->id;
    
        $orderOverviews = OrderOverview::where('id', $orderoverview->id)->first();

        $measurements = Measurements::where('order_id', $orderId)->get();

        $selectedmeasurement = Measurements::where('id', $measurement->id)->first();
    
        $selectedjacket      = $orderoverview->jackets_id      ? Jacket::find($orderoverview->jackets_id)        : null;
        $selected_twopiece   = $orderoverview->two_pieces_id   ? TwoPiece::find($orderoverview->two_pieces_id)   : null;
        $selected_threepiece = $orderoverview->three_pieces_id ? ThreePiece::find($orderoverview->three_pieces_id) : null;
        $selected_shirt      = $orderoverview->shirts_id       ? Shirt::find($orderoverview->shirts_id)          : null;

        if (!$orderOverviews) {
            return redirect()->back()->with('error', 'Order overview not found.');
        }
    
        $orderType = $orderOverviews->type;

        switch ($orderType) {
            case 'Jacket':
                return view('orders.jacket_view', compact(
                    'orders','orderOverviews','measurement','selectedmeasurement','selectedjacket'
                ));

            case 'Shirt':
                return view('orders.shirt_view', compact(
                    'orders','orderOverviews','measurements','selectedmeasurement','selected_shirt'
                ));

            case '2 Piece':
                return view('orders.twopiece_view', compact(
                    'orders','orderOverviews','measurement','selectedmeasurement','selected_twopiece'
                ));

            case '3 Piece':
                return view('orders.threepiece_view', compact(
                    'orders','orderOverviews','measurements','selectedmeasurement','selected_threepiece'
                ));
        }

        abort(404);
    }

    public function update(Request $request, Orders $orders)
    {
        //
    }

    public function destroy(Orders $orders)
    {
        //
    }
}

