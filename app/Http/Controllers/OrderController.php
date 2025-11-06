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
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $sort   = $request->input('sort', 'desc'); // Default to desc

        $allorders = Orders::where('user_id', auth()->id())->get();

        $orders = Orders::where('user_id', auth()->id())
            ->when($search, function ($query) use ($search) {
                return $query->where('order_number', 'LIKE', "%$search%")
                             ->orWhere('name', 'LIKE', "%$search%");
            })
            ->when($status, fn ($q) => $q->where('status', $status))
            ->orderBy('created_at', $sort)
            ->get();
    
        return view('orders.index', compact('allorders', 'orders', 'search', 'status', 'sort'));
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
    
        // Eager-load related item tables (for virtual item_number, etc.)
        $orderOverviews = OrderOverview::with([
            'jacket:id,item_number',
            'shirt:id,item_number',
            'twoPiece:id,item_number',
            'threePiece:id,item_number',
            'trouser:id,item_number',
            'waistcoat:id,item_number',
        ])
        ->where('order_id', $orderId)
        ->get();
    
        $measurements = Measurements::where('order_id', $orderId)->get();
        $totalPrice   = $orderOverviews->sum('price');
    
        return view('orders.order_dashboard', compact('orders', 'measurements', 'orderOverviews', 'totalPrice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders, OrderOverview $orderoverview, Measurements $measurement)
    {
        if ($orders->user_id !== auth()->id()) abort(403);
    
        $orderId        = $orders->id;
        $orderOverviews = OrderOverview::where('id', $orderoverview->id)->first();
        if (!$orderOverviews) return back()->with('error', 'Order overview not found.');
    
        $measurements        = Measurements::where('order_id', $orderId)->get();
        $selectedmeasurement = Measurements::where('id', $measurement->id)->first();
    
        $orderType = strtolower(trim((string) $orderOverviews->type));
    
        $selectedjacket      = null;
        $selected_twopiece   = null;
        $selected_threepiece = null;
        $selectedshirt       = null;
        $selected_waistcoat  = null;
    
        switch ($orderType) {
            case 'jacket':
                if ($orderoverview->jackets_id) {
                    $selectedjacket = Jacket::where('id', $orderoverview->jackets_id)
                                            ->where('order_id', $orderId)->first();
                }
                if (!$selectedjacket) return back()->with('error', 'Jacket not found for this order.');
                return view('orders.jacket_edit', compact(
                    'orders', 'orderOverviews', 'measurements', 'selectedmeasurement', 'selectedjacket'
                ));
    
            case 'shirt':
                $shirtId = $orderoverview->shirt_id ?? $orderoverview->shirts_id ?? null;
                if ($shirtId) {
                    $selectedshirt = Shirt::where('id', $shirtId)
                                          ->where('order_id', $orderId)->first();
                }
                if (!$selectedshirt) return back()->with('error', 'Shirt not found for this order.');
                return view('orders.shirt_edit', compact(
                    'orders', 'orderOverviews', 'measurements', 'selectedmeasurement', 'selectedshirt'
                ));
    
            case '2 piece':
            case 'two piece':
            case '2piece':
                if ($orderoverview->two_pieces_id) {
                    $selected_twopiece = TwoPiece::where('id', $orderoverview->two_pieces_id)
                                                 ->where('order_id', $orderId)->first();
                }
                if (!$selected_twopiece) return back()->with('error', 'Two-piece not found for this order.');
                return view('orders.twopiece_edit', compact(
                    'orders', 'orderOverviews', 'measurements', 'selectedmeasurement', 'selected_twopiece'
                ));
    
            case '3 piece':
            case 'three piece':
            case '3piece':
                if ($orderoverview->three_pieces_id) {
                    $selected_threepiece = ThreePiece::where('id', $orderoverview->three_pieces_id)
                                                     ->where('order_id', $orderId)->first();
                }
                if (!$selected_threepiece) return back()->with('error', 'Three-piece not found for this order.');
                return view('orders.threepiece_edit', compact(
                    'orders', 'orderOverviews', 'measurements', 'selectedmeasurement', 'selected_threepiece'
                ));
    
            case 'waistcoat':
                if ($orderoverview->waistcoat_id) {
                    $selected_waistcoat = Waistcoat::where('id', $orderoverview->waistcoat_id)
                                                   ->where('order_id', $orderId)->first();
                }
                if (!$selected_waistcoat) return back()->with('error', 'Waistcoat not found for this order.');
                return view('orders.waistcoat_edit', compact(
                    'orders', 'orderOverviews', 'measurements', 'selectedmeasurement', 'selected_waistcoat'
                ));
    
            default:
                return back()->with('error', 'Unsupported or missing order type.');
        }
    }

    public function view(Orders $orders, OrderOverview $orderoverview, Measurements $measurement)
    {
        if ($orders->user_id !== auth()->id()) abort(403);
    
        $orderId        = $orders->id;
        $orderOverviews = OrderOverview::where('id', $orderoverview->id)->first();
        if (!$orderOverviews) return back()->with('error', 'Order overview not found.');
    
        $measurements        = Measurements::where('order_id', $orderId)->get();
        $selectedmeasurement = Measurements::where('id', $measurement->id)->first();
        $measurement         = $selectedmeasurement; // keep for existing blades
    
        $orderType = strtolower(trim((string) $orderOverviews->type));
    
        $selectedjacket      = null;
        $selected_twopiece   = null;
        $selected_threepiece = null;
        $selectedshirt       = null;
        $selected_waistcoat  = null;
    
        switch ($orderType) {
            case 'jacket':
                if ($orderoverview->jackets_id) {
                    $selectedjacket = Jacket::where('id', $orderoverview->jackets_id)
                                            ->where('order_id', $orderId)->first();
                }
                if (!$selectedjacket) return back()->with('error', 'Jacket not found for this order.');
                return view('orders.jacket_view', compact(
                    'orders', 'orderOverviews', 'measurement', 'selectedmeasurement', 'selectedjacket'
                ));
    
            case 'shirt':
                $shirtId = $orderoverview->shirt_id ?? $orderoverview->shirts_id ?? null;
                if ($shirtId) {
                    $selectedshirt = Shirt::where('id', $shirtId)
                                          ->where('order_id', $orderId)->first();
                }
                if (!$selectedshirt) return back()->with('error', 'Shirt not found for this order.');
                return view('orders.shirt_view', compact(
                    'orders', 'orderOverviews', 'measurement', 'selectedmeasurement', 'selectedshirt'
                ));
    
            case '2 piece':
            case 'two piece':
            case '2piece':
                if ($orderoverview->two_pieces_id) {
                    $selected_twopiece = TwoPiece::where('id', $orderoverview->two_pieces_id)
                                                 ->where('order_id', $orderId)->first();
                }
                if (!$selected_twopiece) return back()->with('error', 'Two-piece not found for this order.');
                return view('orders.twopiece_view', compact(
                    'orders', 'orderOverviews', 'measurement', 'selectedmeasurement', 'selected_twopiece'
                ));
    
            case '3 piece':
            case 'three piece':
            case '3piece':
                if ($orderoverview->three_pieces_id) {
                    $selected_threepiece = ThreePiece::where('id', $orderoverview->three_pieces_id)
                                                     ->where('order_id', $orderId)->first();
                }
                if (!$selected_threepiece) return back()->with('error', 'Three-piece not found for this order.');
                return view('orders.threepiece_view', compact(
                    'orders', 'orderOverviews', 'measurement', 'selectedmeasurement', 'selected_threepiece'
                ));
    
            case 'waistcoat':
                if ($orderoverview->waistcoat_id) {
                    $selected_waistcoat = Waistcoat::where('id', $orderoverview->waistcoat_id)
                                                   ->where('order_id', $orderId)->first();
                }
                if (!$selected_waistcoat) return back()->with('error', 'Waistcoat not found for this order.');
                return view('orders.waistcoat_view', compact(
                    'orders', 'orderOverviews', 'measurement', 'selectedmeasurement', 'selected_waistcoat'
                ));
    
            default:
                return back()->with('error', 'Unsupported or missing order type.');
        }
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
