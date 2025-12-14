<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\OrderOverview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class FactoryOrderController extends Controller
{
    /**
     * List all items in an order for the factory.
     */
    public function show(Request $request, Orders $order)
    {
        // Load related data, now including user
        $order->load(['overviews', 'measurements', 'user']);
    
        $measurement = $order->measurements->first();
    
        // Try to find the ZIP on disk
        $zipPath = storage_path("app/private/orders/{$order->id}/order_{$order->order_number}.zip");
    
        $zipDownloadUrl = null;
        if (file_exists($zipPath)) {
            $zipDownloadUrl = URL::signedRoute('factory.orders.download', [
                'order' => $order->id,
            ]);
        }
    
        return view('orders.factory_order_preview', [
            'order'          => $order,
            'items'          => $order->overviews,
            'zipDownloadUrl' => $zipDownloadUrl,
            'measurement'    => $measurement,
        ]);
    }
    
    

    public function downloadZip(Orders $order)
    {
        $path = storage_path("app/private/orders/{$order->id}/order_{$order->order_number}.zip");

        if (!file_exists($path)) {
            abort(404, 'ZIP file not found.');
        }

        return response()->download($path, "order_{$order->order_number}.zip");
    }



    /**
     * Show a single item using your existing *_view.blade.php files.
     */
    public function showItem(Request $request, Orders $order, OrderOverview $overview)
    {
        // Ensure the overview really belongs to this order
        if ($overview->order_id !== $order->id) {
            abort(404);
        }
    
        // What the admin views expect
        $orders             = $order;                 // alias to match admin views
        $orderOverviews     = $overview;             // single overview, same var name
        $measurements       = $order->measurements;  // if needed in some views
        $selectedmeasurement = $order->measurements->first();
        $measurement        = $selectedmeasurement;  // some views use $measurement
    
        $selectedjacket      = null;
        $selected_twopiece   = null;
        $selected_threepiece = null;
        $selectedshirt       = null;
        $selected_waistcoat  = null;
    
        // Normalise type like in AdminOrderController
        $type = strtolower(trim((string) $overview->type));
    
        switch ($type) {
            case 'jacket':
                $selectedjacket = $overview->jacket;
                if (!$selectedjacket) abort(404);
                return view('admin.jacket_view', compact(
                    'orders',
                    'orderOverviews',
                    'measurement',
                    'selectedmeasurement',
                    'selectedjacket'
                ));
    
            case 'shirt':
                $selectedshirt = $overview->shirt;
                if (!$selectedshirt) abort(404);
                return view('admin.shirt_view', compact(
                    'orders',
                    'orderOverviews',
                    'measurement',
                    'selectedmeasurement',
                    'selectedshirt'
                ));
    
            // 2-piece
            case '2 piece':
            case 'two piece':
            case '2piece':
            case 'two_piece':
                $selected_twopiece = $overview->twoPiece;
                if (!$selected_twopiece) abort(404);
                return view('admin.twopiece_view', compact(
                    'orders',
                    'orderOverviews',
                    'measurement',
                    'selectedmeasurement',
                    'selected_twopiece'
                ));
    
            // 3-piece
            case '3 piece':
            case 'three piece':
            case '3piece':
            case 'three_piece':
                $selected_threepiece = $overview->threePiece;
                if (!$selected_threepiece) abort(404);
                return view('admin.threepiece_view', compact(
                    'orders',
                    'orderOverviews',
                    'measurement',
                    'selectedmeasurement',
                    'selected_threepiece'
                ));
    
            case 'waistcoat':
                $selected_waistcoat = $overview->waistcoat;
                if (!$selected_waistcoat) abort(404);
                return view('admin.waistcoat_view', compact(
                    'orders',
                    'orderOverviews',
                    'measurement',
                    'selectedmeasurement',
                    'selected_waistcoat'
                ));
    
            default:
                abort(404, 'Unsupported item type: ' . $overview->type);
        }
    }
    
    
    
}
