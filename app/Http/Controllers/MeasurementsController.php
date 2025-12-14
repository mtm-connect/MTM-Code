<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Measurements;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class MeasurementsController extends Controller
{
    /**
     * Quick helper to know if current user is an admin.
     */
    protected function isAdminUser(): bool
    {
        return Auth::check() && in_array(Auth::user()->role, ['admin', 'super']);
    }

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

        // If admin -> can access any order, else only their own
        if ($this->isAdminUser()) {
            $orders = Orders::findOrFail($id);
        } else {
            $orders = Orders::where('user_id', $user->id)->findOrFail($id);
        }

        return view('measurments.measurmentsform', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $id   = request()->route('id');

        $request->validate([
            'name'   => 'required|string|max:255',
            'dob'    => 'required|date',
            'gender' => 'required|string',
        ]);

        Measurements::create([
            'order_id'             => $id,
            'user_id'              => $user->id,
            'name'                 => $request->name,
            'dob'                  => $request->dob,
            'gender'               => $request->gender,
            'height'               => $request->height,
            'weight'               => $request->weight,
            'shoulders'            => $request->shoulders,
            'sleeve_length'        => $request->sleeve_length,
            'bicep'                => $request->bicep,
            'wrist'                => $request->wrist,
            'neck'                 => $request->neck,
            'chest'                => $request->chest,
            'belly'                => $request->belly,
            'waist'                => $request->waist,
            'hip'                  => $request->hip,
            'thigh'                => $request->thigh,
            'knee'                 => $request->knee,
            'cuff'                 => $request->cuff,
            'outside_leg_length'   => $request->outside_leg_length,
            'crotch'               => $request->crotch,
            'inside_leg_length'    => $request->inside_leg_length,
            'inside_sleeve_length' => $request->inside_sleeve_length,
            'pants_cuff_width'     => $request->pants_cuff_width,
            'jacket_length_front'  => $request->jacket_length_front,
            'bs_shoulders'         => $request->bs_shoulders,
            'bs_chest'             => $request->bs_chest,
            'bs_stomach'           => $request->bs_stomach,
            'bs_posture'           => $request->bs_posture,
            'bs_seat'              => $request->bs_seat,
            'special_requirements' => $request->special_requirements,
        ]);
        
        // After create, both admin and user go back to the corresponding order page
        if ($this->isAdminUser()) {
            return redirect()
                ->route('admin.orders.show', ['orders' => $id])
                ->with('success', 'Measurements created successfully.');
        }

        return redirect()
            ->route('orders.show', ['orders' => $id])
            ->with('success', 'Measurements created successfully.');
    }

    /**
     * Display the specified resource.
     * For users: read-only if not draft.
     * For admins: always editable (admin view).
     */
    public function show(Measurements $measurement, Orders $orders)
    {
        if ($measurement->order_id !== $orders->id) {
            abort(404);
        }

        $selectedmeasurement = $measurement;

        // Admin: always editable, admin view
        if ($this->isAdminUser()) {
            $readonly = false;

            return view('admin.measurmentsupdate', compact(
                'orders',
                'selectedmeasurement',
                'readonly'
            ));
        }

        // User: read-only if order not draft
        $readonly = $orders->status !== 'draft';

        return view('measurments.measurmentsupdate', compact(
            'orders',
            'selectedmeasurement',
            'readonly'
        ));
    }
    
    /**
     * Edit page.
     * Users: only when draft, otherwise redirect to read-only show.
     * Admins: always editable, admin view.
     */
    public function edit(Orders $orders, Measurements $measurement)
    {
        if ($measurement->order_id !== $orders->id) {
            abort(404);
        }

        $selectedmeasurement = $measurement;

        // Admin: straight to admin edit view
        if ($this->isAdminUser()) {
            $readonly = false;

            return view('admin.measurmentsupdate', compact(
                'orders',
                'selectedmeasurement',
                'readonly'
            ));
        }

        // User: if not draft, bounce to read-only
        if ($orders->status !== 'draft') {
            return redirect()
                ->route('measurments.show', ['measurement' => $measurement->id, 'orders' => $orders->id])
                ->with('info', 'This order is not editable.');
        }

        $readonly = false;

        return view('measurments.measurmentsupdate', compact(
            'orders',
            'selectedmeasurement',
            'readonly'
        ));
    }
    
    /**
     * Persist edits.
     * Users: only when order is draft.
     * Admins: can always update.
     */
    public function update(Request $request, Orders $orders, Measurements $measurement)
    {
        if ($measurement->order_id !== $orders->id) {
            abort(404);
        }

        $isAdmin = $this->isAdminUser();

        // Users cannot edit non-draft orders
        if (! $isAdmin && $orders->status !== 'draft') {
            abort(403, 'This order is not editable.');
        }

        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'dob'    => 'required|date',
            'gender' => 'required|string',

            'height'               => 'nullable|numeric',
            'weight'               => 'nullable|numeric',
            'shoulders'            => 'nullable|numeric',
            'sleeve_length'        => 'nullable|numeric',
            'bicep'                => 'nullable|numeric',
            'wrist'                => 'nullable|numeric',
            'neck'                 => 'nullable|numeric',
            'chest'                => 'nullable|numeric',
            'belly'                => 'nullable|numeric',
            'waist'                => 'nullable|numeric',
            'hip'                  => 'nullable|numeric',
            'thigh'                => 'nullable|numeric',
            'knee'                 => 'nullable|numeric',
            'cuff'                 => 'nullable|numeric',
            'outside_leg_length'   => 'nullable|numeric',
            'crotch'               => 'nullable|numeric',
            'inside_leg_length'    => 'nullable|numeric',
            'inside_sleeve_length' => 'nullable|numeric',
            'pants_cuff_width'     => 'nullable|numeric',
            'jacket_length_front'  => 'nullable|numeric',

            'bs_shoulders'         => 'nullable|string',
            'bs_chest'             => 'nullable|string',
            'bs_stomach'           => 'nullable|string',
            'bs_posture'           => 'nullable|string',
            'bs_seat'              => 'nullable|string',

            'special_requirements' => 'nullable|string|max:2000',
        ]);
    
        $measurement->update(array_merge($validated, [
            'order_id' => $orders->id,
            'user_id'  => Auth::id(),
        ]));

        // Redirect based on role
        if ($isAdmin) {
            return redirect()
                ->route('admin.orders.show', ['orders' => $orders->id])
                ->with('success', 'Measurements updated successfully.');
        }
    
        return redirect()
            ->route('orders.show', ['orders' => $orders->id])
            ->with('success', 'Measurements updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
