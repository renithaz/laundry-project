<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Customer";
        $customers = Customer::all();
        return view('customer.index', compact('title', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Customer Baru";
        return view('customer.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'phone' => 'required',
            'address' => 'nullable'
        ]);

        Customer::create($request->all());

        Alert::success('Success', 'Customer berhasil ditambahkan');
        return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Ubah Data Customer";
        $customer = Customer::find($id);
        return view('customer.edit', compact('title', 'customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'customer_name' => 'required',
            'phone' => 'required',
            'address' => 'nullable'
        ]);

        $customer = Customer::find($id);
        $customer->update($request->all());
        $customer->save();

        Alert::success('Sukses', 'Data customer berhasil diperbarui');
        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id); //select * from customers where id='$id'
        $customer->delete();
        
        Alert::success('Sukses', 'Data customer berhasil dihapus');
        return redirect()->route('customer.index');
    }
}
