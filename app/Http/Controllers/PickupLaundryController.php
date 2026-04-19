<?php

namespace App\Http\Controllers;

use App\Models\PickupLaundry;
use Illuminate\Http\Request;

class PickupLaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Pickup";
        $pickups = PickupLaundry::with(['order', 'customer'])->latest()->get();
        return view('pickup.index', compact('title','pickups'));
    }

    public function create()
    {
        $title = "Tambah Pickup Laundry";
        $orders = \App\Models\TransOrder::where('order_status', 1)->get(); // 1 means finished
        $customers = \App\Models\Customer::all();
        return view('pickup.create', compact('title','orders', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'customer_id' => 'required',
            'pickup_date' => 'required|date',
            'notes' => 'nullable',
        ]);

        PickupLaundry::create($request->all());

        // Update order status to 2 (Diambil)
        $order = \App\Models\TransOrder::find($request->order_id);
        if ($order) {
            $order->update(['order_status' => 2]);
        }

        return redirect()->route('pickup.index')->with('Sukses', 'Data pickup berhasil ditambahkan');
    }

    public function show(PickupLaundry $pickupLaundry)
    {
        return view('pickup.show', compact('pickupLaundry'));
    }


    public function destroy(PickupLaundry $pickupLaundry)
    {
        $pickupLaundry->delete();
        return redirect()->route('pickup.index')->with('Sukses', 'Data pickup berhasil dihapus');
    }
}
