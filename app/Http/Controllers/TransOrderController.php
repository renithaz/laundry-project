<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Service;
use App\Models\TransOrder;
use App\Models\TransOrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class TransOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = TransOrder::with('customer')->latest()->get();
        return view('transaction.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all()->map(function($c) {
            $hasTransactions = \App\Models\TransOrder::where('customer_id', $c->id)->exists();
            $c->is_new_member = !$hasTransactions;
            return $c;
        });
        $services = Service::all();

        return view('transaction.create', compact('customers', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_type' => 'required|in:member,guest',
            'customer_id'   => 'required_if:customer_type,member',
            'customer_name' => 'required_if:customer_type,guest',
            'customer_phone'=> 'required_if:customer_type,guest',
            'services'      => 'required|array'
        ]);

        DB::beginTransaction();

        try {
            $isNewMember = false;
            $discountPercent = 0;
            $finalCustomerId = null;
            $finalGuestName = null;
            $finalGuestPhone = null;
            $finalGuestAddress = null;

            if ($request->customer_type == 'member') {
                $hasTransactions = TransOrder::where('customer_id', $request->customer_id)->exists();
                if (!$hasTransactions) {
                    $isNewMember = true;
                    $discountPercent += 5;
                }
                $finalCustomerId = $request->customer_id;
            } else {
                if ($request->has('register_member') && $request->register_member == '1') {
                    $newCustomer = Customer::create([
                        'customer_name' => $request->customer_name,
                        'phone' => $request->customer_phone,
                        'address' => $request->customer_address
                    ]);
                    $finalCustomerId = $newCustomer->id;
                    $isNewMember = true;
                    $discountPercent += 5;
                } else {
                    $finalGuestName = $request->customer_name;
                    $finalGuestPhone = $request->customer_phone;
                    $finalGuestAddress = $request->customer_address;
                }
            }

            if (!empty($request->voucher_code)) {
                $discountPercent += 10;
            }

            $order = TransOrder::create([
                'customer_id'      => $finalCustomerId,
                'customer_name'    => $finalGuestName,
                'customer_phone'   => $finalGuestPhone,
                'customer_address' => $finalGuestAddress,
                'voucher_code'     => $request->voucher_code,
                'discount_percent' => $discountPercent,
                'order_code'     => 'ORD-' . time(),
                'order_date'     => $request->order_date,
                'order_end_date' => $request->order_end_date,
                'order_status'   => 0,
                'order_pay'      => $request->cash_received,
                'order_change'   => 0,
                'tax'            => 0,
                'discount_nominal'=> 0,
                'total'          => 0
            ]);

            $total = 0;

            foreach ($request->services as $service) {
                if (empty($service['service_id'])) continue;

                $dataService = Service::find($service['service_id']);

                if (!$dataService) continue;

                $qty = $service['qty'] ?? 1;

                $subtotal = $dataService->price * $qty;

                TransOrderDetail::create([
                    'order_id'   => $order->id,
                    'service_id' => $service['service_id'],
                    'qty'        => $qty,
                    'subtotal'   => $subtotal
                ]);

                $total += $subtotal;
            }

            $discountNominal = $total * ($discountPercent / 100);
            $totalAfterDiscount = $total - $discountNominal;
            $tax = $totalAfterDiscount * 0.10; // 10% Tax
            
            $grandTotal = $totalAfterDiscount + $tax;
            $change = $request->cash_received - $grandTotal;

            $order->update([
                'tax' => $tax,
                'discount_nominal' => $discountNominal,
                'total' => $grandTotal,
                'order_change' => $change
            ]);

            DB::commit();

            return redirect()->route('transaction.index')->with('success', 'Order berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = TransOrder::with(['customer', 'details.service'])->findOrFail($id);

        return view('transaction.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransOrder $transOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'order_status' => 'required|integer|in:0,1,2'
        ]);

        $transaction = TransOrder::findOrFail($id);
        $transaction->update([
            'order_status' => $request->order_status
        ]);

        return redirect()->back()->with('success', 'Status order berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $transorder = TransOrder::find($id);
        $transorder->delete();

        Alert::success('Success', 'Order deleted successfully');
        return redirect()->route('transaction.index');
    }
}
